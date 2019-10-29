<?php
if (isset($_POST['']))
{
// Specify string constants and positioning variables.
define("CASE_CATEGORY", "Category");
define("CASE_LIST", "List");
define("CASE_OBJECTIVE", "Objective");
define("MARGIN", 50);
define("PAGE_HEIGHT", 792);
define("PAGE_WIDTH", 612);
define("TAB", 25);
define("VERT_SPACING", 14);
// Define a couple useful functions.
function drawHR($res) {
	$xpos = MARGIN;
	$ypos = pdf_get_value($res, "texty", 0) - VERT_SPACING;
	pdf_moveto($res, $xpos, $ypos);
	pdf_lineto($res, PAGE_WIDTH - MARGIN, $ypos);
	pdf_closepath($res);
	pdf_fill($res);
	$ypos = pdf_get_value($res, "texty", 0) - (VERT_SPACING * 2);
}
function pdflib_show($res, $text, $type) {
	$font = pdf_findfont($res, "Times-Roman", "winansi", 0);
	$xpos = MARGIN;
	$ypos = pdf_get_value($res, "texty", 0) - VERT_SPACING;
	switch ($type) {
		case CASE_CATEGORY:
			$font = pdf_findfont($res, "Times-Bold", "winansi", 0);
			$ypos = pdf_get_value($res, "texty", 0) - (VERT_SPACING * 3);
		break;
		case CASE_LIST:
			$xpos = MARGIN + TAB;
			$text = "* " . $text;
		break;
		case CASE_OBJECTIVE:
			$font = pdf_findfont($res, "Times-Italic", "winansi", 0);
			$xpos = MARGIN + TAB;
			$text = "\"" . $text . "\"";
		break;
	}
	pdf_setfont($res, $font, 12.0);
	pdf_show_xy($res, $text, $xpos, $ypos);
	return;
}
// Create resource.
$pdf = pdf_new();
if (!pdf_open_file($pdf, "")) {
	die("Error: Unable to open output file.");
}

// Document info.
pdf_set_info($pdf, "Author", "Adeyemi");
pdf_set_info($pdf, "Title", "Resume - ");
pdf_set_info($pdf, "Subject", "The resume of Someone");

// Begin PDF page. -- Can be placed anywhere after the PDF
// resource has been instantiated.
pdf_begin_page($pdf, PAGE_WIDTH, PAGE_HEIGHT);
// Print name.
$font = pdf_findfont($pdf, "Times-Bold", "winansi", 0);
pdf_setfont($pdf, $font, 14.0);
$stringwidth = pdf_stringwidth($pdf, $name, $font, 14.0);

$xpos = (PAGE_WIDTH / 2) - ($stringwidth / 2);
pdf_show_xy($pdf, $name, $xpos, 700);
$xpos = pdf_get_value($pdf, "textx", 0);
$ypos = pdf_get_value($pdf, "texty", 0) - VERT_SPACING;
// Print contact information.
$font = pdf_findfont($pdf, "Times-Roman", "winansi", 0);
pdf_setfont($pdf, $font, 12.0);
$headerdata = array("wer", "efef", "sgfg", "gsfg", "sgfgf", "ae", "sdg", "<table width='100%'></table>");
foreach ($headerdata as $data) {
	$stringwidth = pdf_stringwidth($pdf, $data, $font, 12.0);
	$xpos = (PAGE_WIDTH / 2) - ($stringwidth / 2);
	$ypos = pdf_get_value($pdf, "texty", 0) - VERT_SPACING;
	pdf_show_xy($pdf, $data, $xpos, $ypos);
}
pdf_show_xy($pdf, "Welcome to PDF", 30, 30);
pdf_show_xy($pdf, "Welcome to PDF", 60, 60);
pdf_show_xy($pdf, "Welcome to PDF", 90, 90);

// Wrap up the document and return it to the browser.
pdf_end_page($pdf);
pdf_close($pdf);
$buf = pdf_get_buffer($pdf);
$len = strlen($buf);
header("Content-type: application/pdf");
header("Content-Length: $len");
header("Content-Disposition: inline; filename=resume.pdf");
print $buf;
// Clean up!
$pdf = 0;
}
?>