<?php
// submit_evaluation.php
header('Content-Type: application/json');

// Ajusta la ruta según tu proyecto
require_once "../../model/forms.models.php";

try {
    // 1) Recuperar datos del formulario
    $data = [
        'tipoPersona' => $_POST['tipoPersona'] ?? '',
        'empresa' => $_POST['empresa'] ?? '',
        'giro' => $_POST['giro'] ?? '',
        'fecha_constitucion' => $_POST['fecha_constitucion'] ?? null,
        'web' => $_POST['web'] ?? '',
        'calle' => $_POST['calle'] ?? '',
        'cp' => $_POST['cp'] ?? '',
        'colonia' => $_POST['colonia'] ?? '',
        'ciudad' => $_POST['ciudad'] ?? '',
        'telefonos' => $_POST['telefonos'] ?? '',
        'email' => $_POST['email'] ?? '',
        'nombre_contacto' => $_POST['nombre_contacto'] ?? '',
        'celular' => $_POST['celular'] ?? '',
        'rep_legal' => $_POST['rep_legal'] ?? '',
        'cargo_legal' => $_POST['cargo_legal'] ?? '',
        'email_legal' => $_POST['email_legal'] ?? '',
        'tel_oficina' => $_POST['tel_oficina'] ?? '',
        'actividades' => $_POST['actividades'] ?? '',
    ];

    // 2) Llamar al método de tu modelo
    $result = PracticasModel::saveOrganismoExterno($data);

    // 3) Si el modelo indica error, devolvemos mensaje y salimos
    if (empty($result['success']) || $result['success'] !== true) {
        echo json_encode([
            'success' => false,
            'message' => $result['message'] ?? 'Error al guardar los datos.'
        ]);
        exit;
    }

    // 4) Procesar archivos subidos
    $savedFiles = [];
    if (!empty($_FILES['docs']['name']) && is_array($_FILES['docs']['name'])) {
        // Directorio destino basado en el ID generado por el modelo
        $baseDir = __DIR__ . '/../../uploads/' . $result['id'] . '/';
        if (!is_dir($baseDir) && !mkdir($baseDir, 0777, true)) {
            throw new Exception('No se pudo crear el directorio de uploads: ' . $baseDir);
        }
        if (!is_writable($baseDir)) {
            throw new Exception('No hay permisos de escritura en el directorio: ' . $baseDir);
        }

        // Recorremos cada archivo usando la clave del array (el tipo de documento)
        foreach ($_FILES['docs']['name'] as $key => $originalName) {
            if ($_FILES['docs']['error'][$key] === UPLOAD_ERR_OK) {
                $tmpName = $_FILES['docs']['tmp_name'][$key];
                // Detectamos la extensión real
                $ext = pathinfo($originalName, PATHINFO_EXTENSION);
                // Construimos el nuevo nombre: key + extensión
                $newName = $key . '.' . $ext;
                $destino = $baseDir . $newName;

                if (move_uploaded_file($tmpName, $destino)) {
                    $savedFiles[] = $newName;
                } else {
                    throw new Exception("Error al mover el archivo {$originalName} a {$destino}");
                }
            } else {
                throw new Exception("Error de subida en {$originalName}: código {$_FILES['docs']['error'][$key]}");
            }
        }
    }

    // 5) Respuesta final: todo OK
    echo json_encode([
        'success' => true,
        'message' => 'Datos y archivos guardados correctamente.',
        'id' => $result['id'],
        'files' => $savedFiles
    ]);

} catch (Exception $e) {
    // 6) Captura de excepciones
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}
