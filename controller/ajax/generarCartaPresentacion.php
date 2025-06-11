<?php
require_once __DIR__ . '/../../vendor/autoload.php';

use Dompdf\Dompdf;

session_start();

$idUR        = $_POST['idUR']        ?? '';
$nameUR      = $_POST['nameUR']      ?? '';
$responsable = $_POST['responsable'] ?? '';
$domicilio   = $_POST['domicilio']   ?? '';
$user        = $_SESSION['user'];
$studentName = strtoupper(trim("{$user['firstname']} {$user['lastname']} {$user['lastnameMom']}"));
$matricula   = $user['matricula'];
$genero      = $user['gender'] == 1 ? 'el' : 'la';
$degreeName  = 'Licenciatura';

$meses  = ['enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'];
$fecha  = date('j') . ' de ' . $meses[date('n') - 1] . ' de ' . date('Y');

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
      border-top: 1px solid #ccc;
      width: 60%;
      margin: 0 auto;
      text-align: center;
      margin-top: 100px;
    }

    .firma img {
      width: 150px;
      margin-bottom: 10px;
    }

    .firmante {
      font-weight: bold;
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

    .acuse {
      text-align: center;
      font-size: 9pt;
      margin-top: 6px;
      color: #444;
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
          <img src="https://encuesta.unimontrer.edu.mx/images/logomontrer.png" alt="Logo UNIMO"><br>
        </td>
        <td class="header-right">
          <div class="fecha">Morelia, Michoacán, México, a {$fecha}.</div>
          <div class="asunto">Asunto: <strong>Carta de Presentación de Servicio Social</strong></div>
        </td>
      </tr>
    </table>

    <div class="receptor">
      {$nameUR}<br>
      Atención: {$responsable}<br>
      Domicilio: {$domicilio}<br>
      <strong>Presente</strong>
    </div>

    <div class="cuerpo">
      Por este medio, se presenta ante usted {$genero} estudiante <strong>{$studentName}</strong>, matrícula <strong>{$matricula}</strong>, de la <strong>{$degreeName}</strong> en la Universidad Montrer, con la finalidad de realizar su Servicio Social en el Organismo Receptor mencionado.
      <br><br>
      Agradezco de antemano la atención prestada y quedo a sus órdenes para cualquier duda o aclaración.
    </div>

    <div class="firma">
      ATENTAMENTE<br>
      <img src="" alt="Firma"><br>
      <div class="firmante">{$studentName}</div>
      <div class="puesto">Estudiante de {$degreeName} - Matrícula: {$matricula}</div>
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

// Generación PDF
$dompdf = new Dompdf();
$options = $dompdf->getOptions();
$options->setIsRemoteEnabled(true);
$dompdf->setOptions($options);
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream("CartaPresentacion_{$matricula}.pdf", ["Attachment" => false]);
exit;
