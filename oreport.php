<?php

function fetch_data()
{
  $output='';
  include('db.php');
  $total = 0;
  $cemail = $_GET['cemail'];
  $result = $mysqli->query("SELECT orders.quantity as qty, products.cost_per_item as pci, orders.id as orderid, orders.order_status as order_status, products.product_name as prodname, products.description as proddesc, customers.firstname as cfname, customers.customer_id as custid from orders join products on orders.product_id=products.id join customers on customers.customer_id=orders.customer_id where customers.email='$cemail'");
  
  while ($row = $result->fetch_assoc())
  {
    $pci = $row['pci'];
    $qty = $row['qty'];
    $cost = $qty * $pci;
    $total += $cost;

    $output .= "
      <tr>
        <td>".$row['prodname']."</td>
        <td>".$qty."</td>
        <td>$".$pci."</td>
      </tr>
    ";
  }

  $output .= "
    <tr>
      <td colspan='2' align='right'><b>Total:</b></td>
      <td><b>$".$total."</b></td>
    </tr>
  ";

  return $output;
}

// Include the main TCPDF library (search for installation path).
include('./Admin/library/tcpdf.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('John Elton');
$pdf->SetTitle('Drivers report');
$pdf->SetSubject('TCPDF');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData('logo.png', PDF_HEADER_LOGO_WIDTH, 'Fragrance Lounge', 'P.O.BOX 30372, Nairobi', array(0, 64, 255), array(0, 64, 128));
$pdf->setFooterData(array(0, 64, 0), array(0, 64, 128));

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
  require_once(dirname(__FILE__).'/lang/eng.php');
  $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set default font subsetting mode
$pdf->setFontSubsetting(true);

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
$pdf->SetFont('helvetica', '', 14, '', true);

// Add a page
$pdf->AddPage();

// set text shadow effect
$pdf->setTextShadow(array('enabled' => true, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));

// Set some content to print
$content = '';
$content .= '
<style>
table {
  border-collapse: collapse;
  width: 100%;
}

th, td {
  border: 1px solid #ddd;
  padding: 8px;
  text-align: left;
}

th {
  background-color: #8B008B;
  color: #fff;
  font-weight: bold;
  text-align: center;
}
}

tr:nth-child(even) {
  background-color: #f2f2f2;
}

tr:hover {
  background-color: #ddd;
}

td:last-child {
  text-align: right;
}
</style>
';

$content .= '
<h3 align="center" style="color:purple">Customer Checkout</h3>
<div class="table-responsive">
  <table>
    <tr style="background-color: #FFFAFA; color:purple; text-align: center;">
      <th>ITEM</th>
      <th>QTY</th>
      <th>PRICE</th>
    </tr>
';
$content .= fetch_data();
$content .= '
  </table>
</div>
';

$pdf->writeHTML($content);
$pdf->output('customer_checkout.pdf', 'I');

// Print text using writeHTMLCell()
;

// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->writeHTML($content);

//============================================================+
// END OF FILE
//============================================================+
