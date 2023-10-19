<?php
require('TCPDF/tcpdf.php');

// Create a PDF instance with RTL support
$pdf = new TCPDF('L', 'mm', 'A4', true, 'UTF-8', false);

// Set document information
$pdf->SetCreator('Elmam');
$pdf->SetAuthor('Elmam');
$pdf->SetTitle('التقرير الإسبوعي');
$pdf->SetSubject('التقرير الإسبوعي');
$pdf->SetKeywords('Report, Weekly, PDF');

// Add a page
$pdf->AddPage();

// Set font and size for Arabic text
$pdf->SetFont('dejavusans', '', 12);

// Retrieve the report data from the query parameters
$reportData = json_decode($_GET['reportData'], true);

if ($reportData === null) {
    die('Failed to retrieve report data.');
}

// Define text and values
$texts = [
    'التقرير لغرفة رقم' => $reportData['room'],
    'التقرير من تاريخ' => $reportData['startDate'],
    'إلى تاريخ' => $reportData['endDate'],
    'متوسط درجة الحرارة' => $reportData['average_temperature'] . '°',
    'متوسط درجة الرطوبة' => $reportData['average_humidity'] . '%',
    'متوسط الضوضاء' => $reportData['average_noise'],
    'أعلى درجة حرارة' => $reportData['high_temperature'] . '°',
    'أقل درجة حرارة' => $reportData['low_temperature'] . '°',
];

// Loop through the data and add text with numbers to the PDF
foreach ($texts as $text => $value) {
    $pdf->SetFont('dejavusans', 'B', 16); // Set bold font and size
    $pdf->SetTextColor(0, 51, 102); // Set text color to dark blue
    $pdf->Cell(0, 10, $text . ': ' . $value, 0, 1, 'C'); // Center-align without background color
}

// Set font and size for section headers
$pdf->SetFont('dejavusans', 'B', 18);


// Output the PDF
$pdf->Output('التقرير الإسبوعي.pdf', 'D');
