<?php
require_once "../../model/forms.models.php";
require_once "../forms.controller.php";
require_once __DIR__ . '/../../vendor/autoload.php';

use Dompdf\Dompdf;

session_start();

// 1) Recoger datos del POST y sesión
$idUR        = $_POST['idUR']        ?? '';
$nameUR      = $_POST['nameUR']      ?? '';
$responsable = $_POST['responsable'] ?? '';
$domicilio   = $_POST['domicilio']   ?? '';
$user        = $_SESSION['user'];

$studentName = strtoupper(trim("{$user['firstname']} {$user['lastname']} {$user['lastnameMom']}"));
$matricula   = $user['matricula'];
$genero      = $user['gender'] == 1 ? 'el' : 'la';
$degree = FormsModel::mdlSearchDegrees($user['idDegree']);
$degreeName  = 'LICENCIATURA EN ' . strtoupper($degree['nameDegree'] ?? 'DESCONOCIDA');

// 2) Fecha en español
$meses = [
  'enero',
  'febrero',
  'marzo',
  'abril',
  'mayo',
  'junio',
  'julio',
  'agosto',
  'septiembre',
  'octubre',
  'noviembre',
  'diciembre'
];
$fecha = date('j') . ' de ' . $meses[date('n') - 1] . ' de ' . date('Y');

// Generar folio único para la carta
$folio = ServicioModel::generateFolio($user['idStudent']);

// 3) Generar el HTML con sello superpuesto
$html = <<<HTML
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <style>
    @page { margin: 0; }
    html, body {
      margin: 0;
      padding: 0;
      height: 100%;
      font-family: Arial, sans-serif;
      font-size: 12pt;
    }
    .header-bar {
      background-color: #006837;
      height: 40px;
      width: 100%;
    }
    .contenido {
      padding: 40px;
      padding-bottom: 140px;
      box-sizing: border-box;
    }
    table.header {
      width: 100%;
      border-bottom: 1px solid #ccc;
    }
    .header-left {
      width: 120px;
      text-align: center;
    }
    .header-left img {
      width: 150px;
    }
    .header-right {
      text-align: right;
      vertical-align: top;
    }
    .fecha {
      font-size: 11pt;
      color: #444;
    }
    .asunto {
      margin-top: 10px;
      font-weight: bold;
    }
    .receptor {
      margin-top: 30px;
      font-weight: bold;
      line-height: 1.5;
    }
    .cuerpo {
      margin-top: 20px;
      text-align: justify;
      line-height: 1.6;
    }
    .firma {
      position: relative;
      text-align: center;
      margin-top: 70px;
    }
    .firma img.firma-img {
      width: 200px;
      margin-bottom: 10px;
      position: relative;
      z-index: 1;
    }
    .firma img.sello {
      position: absolute;
      top: -60px;
      left: 50%;
      /* transform: translateX(-%); */
      width: 240px;
      z-index: 2;
      opacity: 0.8;
    }
    .firmante {
      font-weight: bold;
      position: relative;
      z-index: 1;
    }
    .puesto {
      font-size: 11pt;
    }
    .footer {
      position: fixed;
      bottom: 30px;
      left: 0;
      right: 0;
      padding: 0 40px;
      box-sizing: border-box;
    }
    .footer-logo-linea {
      border-top: 1px solid #ccc;
      display: flex;
      align-items: center;
      font-size: 10pt;
      padding-top: 10px;
      color: #444;
    }
    .footer-logo-linea img {
      width: 150px;
      margin-right: 10px;
    }
    .barra-inferior {
      background-color: #006837;
      color: white;
      text-align: center;
      padding: 6px 0;
      font-size: 9pt;
      position: fixed;
      bottom: 0;
      left: 0;
      width: 100%;
    }
  </style>
</head>
<body>
  <div class="header-bar"></div>

  <div class="contenido">
    <table class="header">
      <tr>
        <td class="header-left">
          <img src="https://encuesta.unimontrer.edu.mx/images/logomontrer.png" alt="Logo UNIMO">
        </td>
        <td class="header-right">
          <div class="fecha">Morelia, Michoacán, México, a {$fecha}.</div>
          <div class="asunto">Asunto: <strong>Carta de Presentación de Servicio Social</strong></div>
          <div class="asunto"><strong>{$folio}</strong></div>
        </td>
      </tr>
    </table>

    <div class="receptor">
      {$nameUR}<br>
      {$responsable}<br><br>
      <!-- Domicilio: {$domicilio}<br> -->
      <strong>Presente</strong>
    </div>

    <div class="cuerpo">
      Por este medio, se hace constar que <strong>{$studentName}</strong>, con número de control <strong>{$matricula}</strong>, de la <strong>{$degreeName}</strong> en esta Universidad, ha cumplido los requisitos para desarrollar el <strong>Servicio Social</strong> y es de su interés realizarlo en la institución que usted dignamente representa, considerando que debe cumplir <strong>480 horas</strong> en un periodo de <strong>6 meses</strong>.<br><br>
      El Servicio Social debe ser desarrollado, conforme a lo establecido por el Organismo Público del Gobierno del Estado de Michoacán encargado de regularlo, actualmente denominado <strong>Instituto de la Juventud Michoacana</strong>, por tal motivo, se solicita por favor, sea emitida la <strong>Carta de Aceptación</strong> dirigida al <strong>Lic. Alejandro Cruz Ferreyra, Subdirector de Servicio Social y Pasantes</strong>, indicando el número de horas a cubrir mencionado en el párrafo anterior, así como la fecha de inicio y término.<br><br>
      Sin otro asunto en particular, agradezco de antemano la atención que se sirva brindar a nuestros alumnos, enviándole un cordial saludo.
    </div>

    <div class="firma">
      ATENTAMENTE<br>
      <img src="https://serviciosocial.unimontrer.edu.mx/view/assets/images/firmaOL.png"
           alt="Firma" class="firma-img"><br>
      <img src="https://serviciosocial.unimontrer.edu.mx/view/assets/images/sello%20servicio.png"
           alt="Sello de Servicio Social" class="sello">
      <div class="firmante">C.P. Oscar López García</div>
      <div class="puesto">Coordinador de Servicio Social UNIMO</div>
    </div>
  </div>

  <div class="footer">
    <div class="footer-logo-linea">
      <img src="https://servicios.unimontrer.edu.mx/view/assets/images/logo-color.png" alt="Logo UNIMO">
      <div>
        Tel. 52 (443) 324 0439 · contacto@unimontrer.edu.mx
      </div>
    </div>
  </div>

  <div class="barra-inferior">
    UNIVERSIDAD MONTRER · Universidad en movimiento · www.unimontrer.edu.mx
  </div>
</body>
</html>
HTML;

// 4) Generar el PDF
$dompdf = new Dompdf();
$options = $dompdf->getOptions();
$options->setIsRemoteEnabled(true);
$dompdf->setOptions($options);
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream("CartaPresentacion_{$matricula}.pdf", [
  "Attachment" => false
]);
exit;
