<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use \PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Pdf\Mpdf;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File; 
use Illuminate\Support\Str;
use Carbon\Carbon;
use DB;
use PDF;

class ReportController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function iar($id)
    {
    	$items = DB::table('summaries')
    					->join('inspection_and__acceptances','summaries.reference_id',"=",'inspection_and__acceptances.id')
						->where(['summaries.reference_id' => $id,'inspection_and__acceptances.id'=>$id])
						->orderBy('summaries.created_at', 'asc')
						->get();

		$authsig = DB::table('sign_settings')
    				->get();

    	if($authsig->count()>0){

			$appendix = array(
		    'font'  	=> array(
		        'bold'  => true,
		        'italic'=> true,
		        'color' => array('rgb' => '3b5998'),
		        'size'  => 14,
		        'name'  => 'Times New Roman'
		    ));

		    $forcheck = array(
		    	'font'  	=> array(
		        'bold'  => true,
		        'color' => array('rgb' => '000000'),
		        'size'  => 12,
		        'name'  => 'Wingdings 2'
		    ));

		    $inspection = array(
		    'font'  	=> array(
		        'bold'  => true,
		        'color' => array('rgb' => '000000'),
		        'size'  => 14,
		        'name'  => 'Times New Roman'
		    ));

		    $inspectionfooter = array(
		    'font'  	=> array(
		        'bold'  => true,
		        'italic'=> true,
		        'color' => array('rgb' => '000000'),
		        'size'  => 12,
		        'name'  => 'Times New Roman'
		    ));

		    $entitycluster = array(
		    'font'  	=> array(
		        'bold'  => true,
		        'color' => array('rgb' => '000000'),
		        'size'  => 11,
		        'name'  => 'Times New Roman'
		    ));

		    $headerfont = array(
		    'font'  	=> array(
		        'bold'  => true,
		        'italic'=> true,
		        'color' => array('rgb' => 'ffffff'),
		        'size'  => 11,
		        'name'  => 'Times New Roman'
		    ));

		    $unitfont = array(
		    'font'  	=> array(
		        'bold'  => true,
		        'color' => array('rgb' => '000000'),
		        'size'  => 11,
		        'name'  => 'Calibri'
		    ));

		    $topBorderMedium = array(
			    'borders' => array(
			        'outline' => array(
			            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM,
			            'color' => array('argb' => '000000'),
			        ),
			    ),
			);

			$borderMedium = array(
			    'borders' => array(
			        'outline' => array(
			            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM,
			            'color' => array('argb' => '000000'),
			        ),
			    ),
			);

			$borderThin = array(
			    'borders' => array(
			        'outline' => array(
			            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
			            'color' => array('argb' => '000000'),
			        ),
			    ),
			);

			$allCell = array(
			      'borders' => array(
			          'allBorders' => array(
			              'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
			              'color' => array('argb' => '000000'),
			          )
			      )
			  );

			$borderHair = array(
			    'borders' => array(
			        'outline' => array(
			            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_HAIR,
			            'color' => array('argb' => '000000'),
			        ),
			    ),
			);


		    $spreadsheet = new Spreadsheet();
			$sheet = $spreadsheet->getActiveSheet();
			$sheet = $spreadsheet->getActiveSheet()->setTitle('IAR');

			$sheet->getColumnDimension('A')->setAutoSize(false);
			$sheet->getColumnDimension('A')->setWidth(17.22);
			$sheet->getColumnDimension('B')->setAutoSize(false);
			$sheet->getColumnDimension('B')->setWidth(44.22);
			$sheet->getColumnDimension('C')->setAutoSize(false);
			$sheet->getColumnDimension('C')->setWidth(3.33);
			$sheet->getColumnDimension('D')->setAutoSize(false);
			$sheet->getColumnDimension('D')->setWidth(12.67);
			$sheet->getColumnDimension('E')->setAutoSize(false);
			$sheet->getColumnDimension('E')->setWidth(8.11);
			$sheet->getColumnDimension('F')->setAutoSize(false);
			$sheet->getColumnDimension('F')->setWidth(13.33);

			$sheet->setCellValue('D2', 'Appendix 62');
			$sheet->setCellValue('A5', 'INSPECTION AND ACCEPTANCE REPORT');
			$sheet->mergeCells('A1:F1');
			$sheet->mergeCells('A2:C2');
			$sheet->mergeCells('D2:F2');
			$sheet->mergeCells('A3:F3');
			$sheet->mergeCells('A4:F4');
			$sheet->mergeCells('A5:F5');
			$sheet->getStyle('A5:F5')->getAlignment()->setHorizontal('center');
			$sheet->setCellValue('A6', 'Entity Name : '.$items[0]->entity_name);
			$sheet->setCellValue('D6', 'Fund Cluster : '.$items[0]->cluster);
			$sheet->mergeCells('A6:C6');
			$sheet->mergeCells('D6:F6');
			$sheet->getRowDimension('8')->setRowHeight(22);
			$sheet->getRowDimension('9')->setRowHeight(22);
			$sheet->getRowDimension('10')->setRowHeight(22);
			$sheet->getRowDimension('11')->setRowHeight(22);
			

			$sheet->setCellValue('A8', 'Supplier :');
			$sheet->setCellValue('B8', $items[0]->supplier);
			$sheet->setCellValue('D8', 'IAR No. :');
			$sheet->setCellValue('E8', " ".$items[0]->iar_no);

			$sheet->setCellValue('A9', 'PO No./Date :');
			$sheet->setCellValue('B9', " ".$items[0]->po_number);
			$sheet->setCellValue('D9', 'Date :');
			$sheet->setCellValue('E9', Carbon::parse($items[0]->iar_date)->format('n/j/Y'));


			$sheet->setCellValue('A10', 'Requisitioning Office/Dept. :');
			$sheet->getStyle('A10')->getAlignment()->setWrapText(true);
			$sheet->setCellValue('B10', $items[0]->division);
			$sheet->setCellValue('D10', 'Invoice No. :');
			$sheet->setCellValue('E10', " ".$items[0]->invoice_no);
			$sheet->mergeCells('E10:F10');

			$sheet->setCellValue('A11', 'Respo Center Code :');
			$sheet->setCellValue('B11', $items[0]->papcode);
			$sheet->setCellValue('D11', 'Date :');
			$sheet->setCellValue('E11', Carbon::parse($items[0]->invoice_date)->format('n/j/Y'));
			$sheet->mergeCells('E11:F11');

			$sheet->setCellValue('A13', 'Stock/'.PHP_EOL.'Property No.');
			$sheet->setCellValue('B13', 'Description');
			$sheet->setCellValue('D13', 'Unit/Cost');
			$sheet->setCellValue('E13', 'Quantity');
			$sheet->mergeCells('E13:F13');
			$sheet->getStyle('A13:F13')->getAlignment()->setWrapText(true);
			$sheet->mergeCells('B13:C13');
			$sheet->getStyle('A13:F13')->getAlignment()->setHorizontal('center');
			$sheet->getStyle('A13:F13')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('3b5998');

			$row = 14;
			foreach ($items as $i)
			{
				$sheet->setCellValue('A'.$row, $i->stock_number);
				$sheet->setCellValue('B'.$row, $i->description);
				$sheet->setCellValue('D'.$row, '('.$i->unit.') '.number_format($i->cost, 2, '.', ','));
				$sheet->setCellValue('E'.$row, $i->quantity);
				$sheet->getStyle('E'.$row.':F'.$row)->getAlignment()->setHorizontal('center');
				$sheet->getStyle('A'.$row.':C'.$row)->getAlignment()->setWrapText(true);
				$sheet->getRowDimension($row)->setRowHeight(25);
				$sheet->mergeCells('E'.$row.':F'.$row);
				$sheet->mergeCells('B'.$row.':C'.$row);
				$sheet->getStyle('E'.$row.':F'.$row)->applyFromArray($unitfont);
				$row++;

			}

			$sheet->mergeCells('A'.$row.':F'.$row);
			$row = (int)$row+1;
			$rowborder = (int)$row+1;
			$sheet->setCellValue('A'.$row, 'INSPECTION');
			$sheet->mergeCells('A'.$row.':B'.$row);
			$sheet->setCellValue('C'.$row, 'ACCEPTANCE');
			$sheet->mergeCells('C'.$row.':F'.$row);
			$sheet->getStyle('A'.$row.':F'.$row)->getAlignment()->setHorizontal('center');
			$sheet->getStyle('A'.$row.':F'.$row)->applyFromArray($inspectionfooter);

			$row = (int)$row+1;
			$sheet->setCellValue('A'.$row, 'Date Inspected : '.Carbon::parse($items[0]->date_inspected)->format('n/j/Y'));
			$sheet->setCellValue('C'.$row, 'Date Received : '.Carbon::parse($items[0]->date_receive)->format('n/j/Y'));
			$sheet->getStyle('A'.$row.':F'.$row)->applyFromArray($entitycluster);
			$sheet->mergeCells('A'.$row.':B'.$row);
			$sheet->mergeCells('C'.$row.':F'.$row);
			$sheet->getRowDimension($row)->setRowHeight(31.20);

			$row = (int)$row+1;
			$rowmerge = (int)$row+2;
			$sheet->setCellValue('A'.$row, '     Inspected, verified and found in order as to quantity and specifications');
			$sheet->mergeCells('A'.$row.':B'.$rowmerge);
			$sheet->getStyle('A'.$row.':B'.$rowmerge)->getAlignment()->setWrapText(true);

			if($items[0]->iscomplete==1){
				$sheet->setCellValue('C'.$row, 'R');
				//$sheet->setCellValue('C'.$row, $items[0]->iscomplete);
				$sheet->getStyle('C'.$row)->applyFromArray($forcheck);
			}else{
				$sheet->setCellValue('C'.$row, '*');
				$sheet->getStyle('C'.$row)->applyFromArray($forcheck);
			}

			$sheet->setCellValue('D'.$row, 'Completed');
			$row = (int)$row+1;

			if($items[0]->iscomplete==1){
				$sheet->setCellValue('C'.$row, '*');
				$sheet->getStyle('C'.$row)->applyFromArray($forcheck);
			}else{
				$sheet->setCellValue('C'.$row, 'R');
				$sheet->getStyle('C'.$row)->applyFromArray($forcheck);
			}
			$sheet->setCellValue('D'.$row, 'Partial (pls. specify quantity)');
			$sheet->mergeCells('D'.$row.':F'.$row);
			
			if($items[0]->iscomplete==0){
				$row = (int)$row+1;
				$sheet->setCellValue('D'.$row,'Partial quantity: '. $items[0]->partial_quantity);
			}

			$row = (int)$row+3;
			$sheet->setCellValue('A'.$row,strtoupper($authsig[0]->IARInpector));
			$sheet->mergeCells('A'.$row.':B'.$row);
			$sheet->setCellValue('C'.$row,strtoupper($authsig[0]->IARSupplyOfficer));
			$sheet->mergeCells('C'.$row.':F'.$row);
			$sheet->getStyle('A'.$row.':F'.$row)->getAlignment()->setWrapText(true);
			$sheet->getStyle('A'.$row.':F'.$row)->getAlignment()->setHorizontal('center');
			$sheet->getStyle('A'.$row.':F'.$row)->applyFromArray($entitycluster);

			$row = (int)$row+1;
			$sheet->setCellValue('A'.$row,$authsig[0]->IARInpectorPos);
			$sheet->mergeCells('A'.$row.':B'.$row);
			$sheet->getStyle('A'.$row.':B'.$row)->applyFromArray($borderThin);
			$sheet->setCellValue('C'.$row,$authsig[0]->IARSupplyOfficerPos);
			$sheet->mergeCells('C'.$row.':F'.$row);
			$sheet->getStyle('C'.$row.':F'.$row)->applyFromArray($borderThin);
			$sheet->getStyle('A'.$row.':F'.$row)->getAlignment()->setWrapText(true);
			$sheet->getStyle('A'.$row.':F'.$row)->getAlignment()->setHorizontal('center');

			$sheet->getStyle('D2')->applyFromArray($appendix);
			$sheet->getStyle('A5')->applyFromArray($inspection);
			$sheet->getStyle('A6:F6')->applyFromArray($entitycluster);
			$sheet->getStyle('A13:F'.$rowborder)->applyFromArray($allCell);
			$sheet->getStyle('C'.$row.':F'.$rowborder)->applyFromArray($borderThin);
			$fborder = $row-6;
			$sheet->getStyle('C'.$fborder.':F'.$row)->applyFromArray($borderThin);
			$sheet->getStyle('A'.$fborder.':B'.$row)->applyFromArray($borderThin);
			$sheet->getStyle('D8:F12')->applyFromArray($borderThin);
			$sheet->getStyle('A13:F'.$row)->applyFromArray($borderMedium);
			$sheet->getStyle('A8:F12')->applyFromArray($borderMedium);
			$sheet->getStyle('A13:F13')->applyFromArray($headerfont);
			$sheet->getRowDimension('6')->setRowHeight(31.22);
			$sheet->getStyle('A6:F6')->getAlignment()->setHorizontal('left');
			$sheet->getStyle('A5:F'.$row)->getAlignment()->setVertical('center');
			$sheet->getStyle('A5:F'.$row)->getAlignment()->setVertical('center');

			$protect = Str::random(10);

			$sheet->getProtection()->setSheet(true);
			$sheet->getProtection()->setSort(true);
			$sheet->getProtection()->setInsertRows(true);
			$sheet->getProtection()->setFormatCells(true);

			$sheet->getProtection()->setPassword($protect);

			$writer = new Xlsx($spreadsheet);
			$writer->save('Inspection and Acceptance Report.xlsx');

			$filename="Inspection and Acceptance Report.xlsx";
			$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader("Xlsx");
			$spreadsheet = $reader->load("$filename");

			$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Mpdf');

			$pdf_path = 'Inspection and Acceptance Report.pdf';
			$writer->save($pdf_path);

			//return redirect('/'.$pdf_path);
			return redirect('/'.$filename);
		}else{
			//echo "Please fill up first the Signatures in Settings";

			return redirect('/error-sign');
		}
    }

    public function iar_list_all()
    {
    	$items = DB::table('inspection_and__acceptances')
                    ->orderBy('iscomplete', 'asc')
                    ->orderBy('created_at', 'desc')
                    ->get();

        $reorderdata = DB::table('stock_libs')
                ->join('summaries','summaries.stock_number','stock_libs.stock_code')
                ->where(['summaries.type'=>'iar'])
                ->select(DB::raw('stock_libs.id as id'),DB::raw('stock_libs.stock_code as stock_code'),DB::raw('stock_libs.description as description'),DB::raw('stock_libs.unit as unit'),DB::raw('stock_libs.expense_category as expense_category'),DB::raw('stock_libs.reorderpoint as reorderpoint'),DB::raw('sum(summaries.available) as available'))
                ->groupBy('stock_libs.stock_code')
                ->get();

        $appendix = array(
		    'font'  	=> array(
		        'bold'  => true,
		        'italic'=> true,
		        'color' => array('rgb' => '3b5998'),
		        'size'  => 14,
		        'name'  => 'Times New Roman'
		    ));

		    $forcheck = array(
		    	'font'  	=> array(
		        'bold'  => true,
		        'color' => array('rgb' => '000000'),
		        'size'  => 12,
		        'name'  => 'Wingdings 2'
		    ));

		    $inspection = array(
		    'font'  	=> array(
		        'bold'  => true,
		        'color' => array('rgb' => '000000'),
		        'size'  => 14,
		        'name'  => 'Times New Roman'
		    ));

		    $inspectionfooter = array(
		    'font'  	=> array(
		        'bold'  => true,
		        'italic'=> true,
		        'color' => array('rgb' => '000000'),
		        'size'  => 12,
		        'name'  => 'Times New Roman'
		    ));

		    $entitycluster = array(
		    'font'  	=> array(
		        'bold'  => true,
		        'color' => array('rgb' => '000000'),
		        'size'  => 11,
		        'name'  => 'Times New Roman'
		    ));

		    $headerfont = array(
		    'font'  	=> array(
		        'bold'  => true,
		        'italic'=> true,
		        'color' => array('rgb' => 'ffffff'),
		        'size'  => 11,
		        'name'  => 'Times New Roman'
		    ));

		    $unitfont = array(
		    'font'  	=> array(
		        'bold'  => true,
		        'color' => array('rgb' => '000000'),
		        'size'  => 11,
		        'name'  => 'Calibri'
		    ));

		    $topBorderMedium = array(
			    'borders' => array(
			        'outline' => array(
			            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM,
			            'color' => array('argb' => '000000'),
			        ),
			    ),
			);

			$borderMedium = array(
			    'borders' => array(
			        'outline' => array(
			            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM,
			            'color' => array('argb' => '000000'),
			        ),
			    ),
			);

			$borderThin = array(
			    'borders' => array(
			        'outline' => array(
			            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
			            'color' => array('argb' => '000000'),
			        ),
			    ),
			);

			$allCell = array(
			      'borders' => array(
			          'allBorders' => array(
			              'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
			              'color' => array('argb' => '000000'),
			          )
			      )
			  );

			$borderHair = array(
			    'borders' => array(
			        'outline' => array(
			            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_HAIR,
			            'color' => array('argb' => '000000'),
			        ),
			    ),
			);

        	$spreadsheet = new Spreadsheet();
			$sheet = $spreadsheet->getActiveSheet();
			$sheet = $spreadsheet->getActiveSheet()->setTitle('IAR LIST');
	
			$sheet->getColumnDimension('A')->setAutoSize(false);
			$sheet->getColumnDimension('A')->setWidth(17.22);
			$sheet->getColumnDimension('B')->setAutoSize(false);
			$sheet->getColumnDimension('B')->setWidth(13.44);
			$sheet->getColumnDimension('C')->setAutoSize(false);
			$sheet->getColumnDimension('C')->setWidth(28);
			$sheet->getColumnDimension('D')->setAutoSize(false);
			$sheet->getColumnDimension('D')->setWidth(18);
			$sheet->getColumnDimension('E')->setAutoSize(false);
			$sheet->getColumnDimension('E')->setWidth(18);
			$sheet->getColumnDimension('F')->setAutoSize(false);
			$sheet->getColumnDimension('F')->setWidth(13.33);

			$sheet->setCellValue('A2', 'LIST OF INSPECTION AND ACCEPTANCE REPORT');
			$sheet->mergeCells('A2:F2');
			$sheet->getStyle('A2:F2')->getAlignment()->setHorizontal('center');
			$sheet->setCellValue('A4', 'Entity Name : '.$items[0]->entity_name);
			$sheet->setCellValue('D4', 'Fund Cluster : '.$items[0]->cluster);
			$sheet->mergeCells('A4:C4');
			$sheet->mergeCells('D4:F4');
			$sheet->getRowDimension('6')->setRowHeight(35);
			$sheet->getRowDimension('8')->setRowHeight(22);
			$sheet->getRowDimension('9')->setRowHeight(22);
			$sheet->getRowDimension('10')->setRowHeight(22);
			$sheet->getRowDimension('11')->setRowHeight(22);


			$sheet->setCellValue('A6','PO No./Date');
			$sheet->setCellValue('B6','IAR No.');
			$sheet->setCellValue('C6','Supplier');
			$sheet->setCellValue('D6','Requisitioning Office/Dept.');
			$sheet->setCellValue('E6','Respo Center Code');
			$sheet->setCellValue('F6','Status');
			$sheet->getStyle('A6:F6')->getAlignment()->setHorizontal('center');
			$sheet->getStyle('A6:F6')->getAlignment()->setVertical('center');
			$sheet->getStyle('A6:F6')->getAlignment()->setWrapText(true);
			$sheet->getStyle('A6:F6')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('3b5998');
			$sheet->getStyle('A6:F6')->applyFromArray($allCell);
			$sheet->getStyle('A6:F6')->applyFromArray($headerfont);
			
		
			$row = 7;
			foreach ($items as $i)
			{

				if($i->type=='iar')
				{
					$sheet->setCellValue('A'.$row, " ".$i->po_number);
					$sheet->setCellValue('B'.$row, " ".$i->iar_no);
					$sheet->setCellValue('C'.$row, $i->supplier);
					$sheet->setCellValue('D'.$row, $i->department);
					$sheet->setCellValue('E'.$row, $i->responsibility_code);

					if($i->iscomplete==0)
					{
						$sheet->setCellValue('F'.$row, 'Pending');
					}else{
						$sheet->setCellValue('F'.$row, 'Completed');
					}

						$sheet->getStyle('E'.$row.':F'.$row)->getAlignment()->setHorizontal('center');
						$sheet->getStyle('A'.$row.':C'.$row)->getAlignment()->setWrapText(true);
						$sheet->getRowDimension($row)->setRowHeight(25);
						$row++;
				}

			}

			$sheet->setCellValue('A'.(int)$row, '************************** NOTHING FOLLOWS **************************');
			$sheet->mergeCells('A'.$row.':F'.$row);
			$sheet->getStyle('A'.$row.':F'.$row)->getAlignment()->setHorizontal('center');
			$sheet->getStyle('A7:F'.$row)->applyFromArray($allCell);
			$sheet->getRowDimension($row)->setRowHeight(31.20);

			
			$protect = Str::random(10);

			$sheet->getProtection()->setSheet(true);
			$sheet->getProtection()->setSort(true);
			$sheet->getProtection()->setInsertRows(true);
			$sheet->getProtection()->setFormatCells(true);

			$sheet->getProtection()->setPassword($protect);

			$writer = new Xlsx($spreadsheet);
			$writer->save('Inspection and Acceptance Report.xlsx');

			$filename="Inspection and Acceptance Report.xlsx";
			$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader("Xlsx");
			$spreadsheet = $reader->load("$filename");

			$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Mpdf');

			$pdf_path = 'Inspection and Acceptance Report.pdf';
			$writer->save($pdf_path);

			//return redirect('/'.$pdf_path);
			return redirect('/'.$filename);

    }

    //---------------
    public function iar_list_filtered($iarnumber)
    {
    	$items = DB::table('inspection_and__acceptances')
    				->where(['inspection_and__acceptances.iar_no'=>$iarnumber])
                    ->orderBy('iscomplete', 'asc')
                    ->orderBy('created_at', 'desc')
                    ->get();

        $reorderdata = DB::table('stock_libs')
                ->join('summaries','summaries.stock_number','stock_libs.stock_code')
                ->where(['summaries.type'=>'iar'])
                ->select(DB::raw('stock_libs.id as id'),DB::raw('stock_libs.stock_code as stock_code'),DB::raw('stock_libs.description as description'),DB::raw('stock_libs.unit as unit'),DB::raw('stock_libs.expense_category as expense_category'),DB::raw('stock_libs.reorderpoint as reorderpoint'),DB::raw('sum(summaries.available) as available'))
                ->groupBy('stock_libs.stock_code')
                ->get();

        $appendix = array(
		    'font'  	=> array(
		        'bold'  => true,
		        'italic'=> true,
		        'color' => array('rgb' => '3b5998'),
		        'size'  => 14,
		        'name'  => 'Times New Roman'
		    ));

		    $forcheck = array(
		    	'font'  	=> array(
		        'bold'  => true,
		        'color' => array('rgb' => '000000'),
		        'size'  => 12,
		        'name'  => 'Wingdings 2'
		    ));

		    $inspection = array(
		    'font'  	=> array(
		        'bold'  => true,
		        'color' => array('rgb' => '000000'),
		        'size'  => 14,
		        'name'  => 'Times New Roman'
		    ));

		    $inspectionfooter = array(
		    'font'  	=> array(
		        'bold'  => true,
		        'italic'=> true,
		        'color' => array('rgb' => '000000'),
		        'size'  => 12,
		        'name'  => 'Times New Roman'
		    ));

		    $entitycluster = array(
		    'font'  	=> array(
		        'bold'  => true,
		        'color' => array('rgb' => '000000'),
		        'size'  => 11,
		        'name'  => 'Times New Roman'
		    ));

		    $headerfont = array(
		    'font'  	=> array(
		        'bold'  => true,
		        'italic'=> true,
		        'color' => array('rgb' => 'ffffff'),
		        'size'  => 11,
		        'name'  => 'Times New Roman'
		    ));

		    $unitfont = array(
		    'font'  	=> array(
		        'bold'  => true,
		        'color' => array('rgb' => '000000'),
		        'size'  => 11,
		        'name'  => 'Calibri'
		    ));

		    $topBorderMedium = array(
			    'borders' => array(
			        'outline' => array(
			            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM,
			            'color' => array('argb' => '000000'),
			        ),
			    ),
			);

			$borderMedium = array(
			    'borders' => array(
			        'outline' => array(
			            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM,
			            'color' => array('argb' => '000000'),
			        ),
			    ),
			);

			$borderThin = array(
			    'borders' => array(
			        'outline' => array(
			            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
			            'color' => array('argb' => '000000'),
			        ),
			    ),
			);

			$allCell = array(
			      'borders' => array(
			          'allBorders' => array(
			              'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
			              'color' => array('argb' => '000000'),
			          )
			      )
			  );

			$borderHair = array(
			    'borders' => array(
			        'outline' => array(
			            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_HAIR,
			            'color' => array('argb' => '000000'),
			        ),
			    ),
			);

        	$spreadsheet = new Spreadsheet();
			$sheet = $spreadsheet->getActiveSheet();
			$sheet = $spreadsheet->getActiveSheet()->setTitle('IAR LIST');
	
			$sheet->getColumnDimension('A')->setAutoSize(false);
			$sheet->getColumnDimension('A')->setWidth(17.22);
			$sheet->getColumnDimension('B')->setAutoSize(false);
			$sheet->getColumnDimension('B')->setWidth(13.44);
			$sheet->getColumnDimension('C')->setAutoSize(false);
			$sheet->getColumnDimension('C')->setWidth(28);
			$sheet->getColumnDimension('D')->setAutoSize(false);
			$sheet->getColumnDimension('D')->setWidth(18);
			$sheet->getColumnDimension('E')->setAutoSize(false);
			$sheet->getColumnDimension('E')->setWidth(18);
			$sheet->getColumnDimension('F')->setAutoSize(false);
			$sheet->getColumnDimension('F')->setWidth(13.33);

			$sheet->setCellValue('A2', 'LIST OF INSPECTION AND ACCEPTANCE REPORT');
			$sheet->mergeCells('A2:F2');
			$sheet->getStyle('A2:F2')->getAlignment()->setHorizontal('center');
			$sheet->setCellValue('A4', 'Entity Name : '.$items[0]->entity_name);
			$sheet->setCellValue('D4', 'Fund Cluster : '.$items[0]->cluster);
			$sheet->mergeCells('A4:C4');
			$sheet->mergeCells('D4:F4');
			$sheet->getRowDimension('6')->setRowHeight(35);
			$sheet->getRowDimension('8')->setRowHeight(22);
			$sheet->getRowDimension('9')->setRowHeight(22);
			$sheet->getRowDimension('10')->setRowHeight(22);
			$sheet->getRowDimension('11')->setRowHeight(22);


			$sheet->setCellValue('A6','PO No./Date');
			$sheet->setCellValue('B6','IAR No.');
			$sheet->setCellValue('C6','Supplier');
			$sheet->setCellValue('D6','Requisitioning Office/Dept.');
			$sheet->setCellValue('E6','Respo Center Code');
			$sheet->setCellValue('F6','Status');
			$sheet->getStyle('A6:F6')->getAlignment()->setHorizontal('center');
			$sheet->getStyle('A6:F6')->getAlignment()->setVertical('center');
			$sheet->getStyle('A6:F6')->getAlignment()->setWrapText(true);
			$sheet->getStyle('A6:F6')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('3b5998');
			$sheet->getStyle('A6:F6')->applyFromArray($allCell);
			$sheet->getStyle('A6:F6')->applyFromArray($headerfont);
			
		
			$row = 7;
			foreach ($items as $i)
			{

				if($i->type=='iar')
				{
					$sheet->setCellValue('A'.$row, " ".$i->po_number);
					$sheet->setCellValue('B'.$row, " ".$i->iar_no);
					$sheet->setCellValue('C'.$row, $i->supplier);
					$sheet->setCellValue('D'.$row, $i->department);
					$sheet->setCellValue('E'.$row, $i->responsibility_code);

					if($i->iscomplete==0)
					{
						$sheet->setCellValue('F'.$row, 'Pending');
					}else{
						$sheet->setCellValue('F'.$row, 'Completed');
					}

						$sheet->getStyle('E'.$row.':F'.$row)->getAlignment()->setHorizontal('center');
						$sheet->getStyle('A'.$row.':C'.$row)->getAlignment()->setWrapText(true);
						$sheet->getRowDimension($row)->setRowHeight(25);
						$row++;
				}

			}

			$sheet->setCellValue('A'.(int)$row, '************************** NOTHING FOLLOWS **************************');
			$sheet->mergeCells('A'.$row.':F'.$row);
			$sheet->getStyle('A'.$row.':F'.$row)->getAlignment()->setHorizontal('center');
			$sheet->getStyle('A7:F'.$row)->applyFromArray($allCell);
			$sheet->getRowDimension($row)->setRowHeight(31.20);

			
			$protect = Str::random(10);

			$sheet->getProtection()->setSheet(true);
			$sheet->getProtection()->setSort(true);
			$sheet->getProtection()->setInsertRows(true);
			$sheet->getProtection()->setFormatCells(true);

			$sheet->getProtection()->setPassword($protect);

			$writer = new Xlsx($spreadsheet);
			$writer->save('Inspection and Acceptance Report.xlsx');

			$filename="Inspection and Acceptance Report.xlsx";
			$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader("Xlsx");
			$spreadsheet = $reader->load("$filename");

			$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Mpdf');

			$pdf_path = 'Inspection and Acceptance Report.pdf';
			$writer->save($pdf_path);

			//return redirect('/'.$pdf_path);
			return redirect('/'.$filename);

    }

    //---------------

    public function ris($id,$id2)
    {
    	$data = DB::table('summaries')
                        ->where(['summaries.division'=>$id,'summaries.series_id'=>$id2,'summaries.type'=>'ris'])
                        ->get();

/*
        $items = DB::table('request__details')
                        ->where(['request__details.series_id'=>$id2])
                        ->get();
*/
        $query1 = DB::table('requests')
                        ->where(['requests.id'=>$id2])
                        ->get();


       $appendix = array(
	    	'font' 	=> array(
	        'bold'  => true,
	        'italic'=> true,
	        'color' => array('rgb' => '3b5998'),
	        'size'  => 16,
	        'name'  => 'Times New Roman'
	    ));

        $headerfont = array(
	    	'font' 	=> array(
	        'bold'  => true,
	        'color' => array('rgb' => '000000'),
	        'size'  => 12,
	        'name'  => 'Times New Roman'
	    ));

	    $entityfont = array(
	    	'font' 	=> array(
	        'color' => array('rgb' => '000000'),
	        'size'  => 12,
	        'name'  => 'Times New Roman'
	    ));


	    $unitfonttop = array(
	    	'font' 	=> array(
	        'bold'  => true,
	        'italic'=> true,
	        'color' => array('rgb' => 'ffffff'),
	        'size'  => 14,
	        'name'  => 'Times New Roman'
	    ));

	    $unitfonttopmiddle = array(
	    	'font' 	=> array(
	        'bold'  => true,
	        'italic'=> true,
	        'color' => array('rgb' => '000000'),
	        'size'  => 12,
	        'name'  => 'Times New Roman'
	    ));

	    $unitfontbottom = array(
	    	'font'  => array(
	        'color' => array('rgb' => 'ffffff'),
	        'size'  => 12,
	        'name'  => 'Times New Roman'
	    ));

	    $unitfontbottom2 = array(
	    	'font' 	=> array(
	        'color' => array('rgb' => '000000'),
	        'size'  => 12,
	        'name'  => 'Times New Roman'
	    ));

	    $signaturefontbottom = array(
	    	'font' 	=> array(
	    	'bold'  => true,
	        'color' => array('rgb' => '000000'),
	        'size'  => 12,
	        'name'  => 'Times New Roman'
	    ));

		$forcheck = array(
	    	'font'  => array(
	        'bold'  => true,
	        'color' => array('rgb' => '000000'),
	        'size'  => 12,
	        'name'  => 'Wingdings 2'
	    ));

	    $borderMedium = array(
		    'borders' => array(
		        'outline' => array(
		            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM,
		            'color' => array('argb' => '000000'),
		        ),
		    ),
		);

		$borderAllMedium = array(
		    'borders' => array(
		        'allBorders' => array(
		            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM,
		            'color' => array('argb' => '000000'),
		        ),
		    ),
		);

		$borderThin = array(
		    'borders' => array(
		        'outline' => array(
		            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
		            'color' => array('argb' => '000000'),
		        ),
		    ),
		);

		$allCell = array(
		      'borders' => array(
		          'allBorders' => array(
		              'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
		              'color' => array('argb' => '000000'),
		          )
		      )
		  );

		$allCellWhite = array(
		      'borders' => array(
		          'allBorders' => array(
		              'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
		              'color' => array('argb' => 'ffffff'),
		          )
		      )
		  );

		$allCellMedium = array(
		      'borders' => array(
		          'allBorders' => array(
		              'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM,
		              'color' => array('argb' => '000000'),
		          )
		      )
		  );

		$borderHair = array(
		    'borders' => array(
		        'outline' => array(
		            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_HAIR,
		            'color' => array('argb' => '000000'),
		        ),
		    ),
		);

        $spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();
		$sheet = $spreadsheet->getActiveSheet()->setTitle('RIS');

		$sheet->getColumnDimension('A')->setAutoSize(false);
		$sheet->getColumnDimension('A')->setWidth(11.11);
		$sheet->getColumnDimension('B')->setAutoSize(false);
		$sheet->getColumnDimension('B')->setWidth(5.78);
		$sheet->getColumnDimension('C')->setAutoSize(false);
		$sheet->getColumnDimension('C')->setWidth(23.89);
		$sheet->getColumnDimension('D')->setAutoSize(false);
		$sheet->getColumnDimension('D')->setWidth(12.89);
		$sheet->getColumnDimension('E')->setAutoSize(false);
		$sheet->getColumnDimension('E')->setWidth(12.67);
		$sheet->getColumnDimension('F')->setAutoSize(false);
		$sheet->getColumnDimension('F')->setWidth(12.89);
		$sheet->getColumnDimension('G')->setAutoSize(false);
		$sheet->getColumnDimension('G')->setWidth(13.22);
		$sheet->getColumnDimension('H')->setAutoSize(false);
		$sheet->getColumnDimension('H')->setWidth(29.83);

		$sheet->setCellValue('H2', 'Appendix 63');
		$sheet->setCellValue('A4', 'REQUISITION AND ISSUE SLIP');
		$sheet->mergeCells('A4:H4');
		$sheet->setCellValue('A6', 'Entity Name: MINDANAO DEVELOPMENT AUTHORITY');
		$sheet->setCellValue('G6', 'Fund Cluster : '.$data[0]->cluster);
		$sheet->setCellValue('A8', 'Division : ');
		$sheet->setCellValue('B8', $data[0]->division);
		$sheet->setCellValue('F8', 'Responsibility Center Code : ');
		$sheet->setCellValue('H8', $data[0]->papcode);
		$sheet->setCellValue('A9', 'Office : ');
		$sheet->setCellValue('B9', $query1[0]->office);
		$sheet->setCellValue('F9', 'RIS No. : ');
		$sheet->setCellValue('H9', $data[0]->ris_num);
		$sheet->setCellValue('A10', 'Requisition');
		$sheet->setCellValue('E10', 'Stock Available?');
		$sheet->setCellValue('G10', 'Issue');
		$sheet->setCellValue('A11', 'Stock No.');
		$sheet->setCellValue('B11', 'Unit');
		$sheet->setCellValue('C11', 'Description');
		$sheet->setCellValue('D11', 'Quantity');
		$sheet->setCellValue('E11', 'Yes');
		$sheet->setCellValue('F11', 'No');
		$sheet->setCellValue('G11', 'Quantity');
		$sheet->setCellValue('H11', 'Remarks');
		$sheet->mergeCells('A10:D10');
		$sheet->mergeCells('E10:F10');
		$sheet->mergeCells('G10:H10');
		$sheet->getRowDimension(8)->setRowHeight(20);
		$sheet->getRowDimension(9)->setRowHeight(20);
		$sheet->getRowDimension(10)->setRowHeight(20);
		$sheet->getRowDimension(11)->setRowHeight(20);


		$row=12;
		foreach($data as $i)
		{
			$sheet->setCellValue('A'.$row, $i->stock_number);
			$sheet->setCellValue('B'.$row, $i->unit);
			$sheet->setCellValue('C'.$row, $i->item);

			$bal = DB::table('summaries')
						->where(['summaries.stock_number'=>$i->stock_number,'summaries.item'=>$i->item])
						->get();

			//$sheet->setCellValue('D'.$row, $i->quantity);
			$sheet->setCellValue('D'.$row, $i->quantity);

				if($bal[0]->available>0){
					$sheet->setCellValue('E'.$row, 'R');
					$sheet->getStyle('E'.$row)->applyFromArray($forcheck);
				}else{
					$sheet->setCellValue('F'.$row, 'R');
					$sheet->getStyle('F'.$row)->applyFromArray($forcheck);
				}
			$sheet->getStyle('A'.$row.':C'.$row)->getAlignment()->setWrapText('true');
			$sheet->getStyle('E'.$row.':F'.$row)->getAlignment()->setHorizontal('center');
			$sheet->getStyle('A'.$row.':H'.$row)->getAlignment()->setVertical('center');
			$sheet->setCellValue('G'.$row, $i->available);
			$sheet->setCellValue('H'.$row, $i->remarks);
			$sheet->getRowDimension($row)->setRowHeight(20);
			$sheet->getStyle('A'.$row.':H'.$row)->applyFromArray($allCell);
			$row++;
		}

	
		$sheet->getStyle('A10:H11')->applyFromArray($allCellWhite);
		$sheet->getStyle('A'.$row.':H'.$row)->applyFromArray($borderThin);
		$row=(int)$row+1;
		$pend=(int)$row+4;
		$rowmerge=(int)$row+4;
		$sheet->getStyle('A12:H'.$row)->applyFromArray($borderMedium);
		$sheet->setCellValue('A'.$row, 'Purpose:');
		$sheet->mergeCells('B'.$row.':H'.$rowmerge);
		$sheet->setCellValue('B'.$row, $query1[0]->purpose);
		$sheet->getStyle('B'.$row)->getAlignment()->setVertical('top');
		$sheet->getStyle('B'.$row.':H'.$rowmerge)->getAlignment()->setWrapText(true);
		$sheet->getStyle('A'.$row.':A'.$rowmerge)->applyFromArray($borderThin);
		$sheet->getStyle('B'.$row.':H'.$rowmerge)->applyFromArray($borderThin);
		$sheet->getStyle('A'.$row.':H'.$pend)->applyFromArray($borderMedium);
		$rowmerge=(int)$rowmerge+1;
		$sheet->setCellValue('C'.$rowmerge, 'Requested by:');
		$sheet->getStyle('C'.$rowmerge.':H'.$rowmerge)->applyFromArray($allCell);
		$sheet->getStyle('A'.$rowmerge.':H'.$rowmerge)->applyFromArray($unitfonttopmiddle);
		$sheet->setCellValue('D'.$rowmerge, 'Approved by:');
		$sheet->mergeCells('D'.$rowmerge.':E'.$rowmerge);
		$sheet->setCellValue('F'.$rowmerge, 'Issued by:');
		$sheet->mergeCells('F'.$rowmerge.':G'.$rowmerge);
		$sheet->mergeCells('A'.$rowmerge.':B'.$rowmerge);
		$sheet->setCellValue('H'.$rowmerge, 'Received by:');
		$sheet->getStyle('A'.$rowmerge.':H'.$rowmerge)->applyFromArray($allCellMedium);

		$rowmerge=(int)$rowmerge+1;
		$rstart=(int)$rowmerge;
		$rend=(int)$rowmerge+3;
		

		$sheet->setCellValue('A'.$rowmerge, 'Signature:');
		$sheet->getRowDimension($rowmerge)->setRowHeight(20);
		$sheet->mergeCells('D'.$rowmerge.':E'.$rowmerge);
		$sheet->mergeCells('F'.$rowmerge.':G'.$rowmerge);
		$sheet->getStyle('C'.$rowmerge.':H'.$rowmerge)->applyFromArray($allCell);
		$sheet->getStyle('A'.$rowmerge.':B'.$rowmerge)->applyFromArray($borderThin);
		$sheet->getStyle('A'.$rowmerge.':H'.$rowmerge)->applyFromArray($unitfontbottom2);
		$sheet->getStyle('C'.$rowmerge.':H'.$rowmerge)->getAlignment()->setHorizontal('center');

		$rowmerge=(int)$rowmerge+1;
		$sheet->setCellValue('A'.$rowmerge, 'Print Name:');
		$sheet->getRowDimension($rowmerge)->setRowHeight(20);
		$sheet->mergeCells('D'.$rowmerge.':E'.$rowmerge);
		$sheet->mergeCells('F'.$rowmerge.':G'.$rowmerge);
		$sheet->setCellValue('C'.$rowmerge, strtoupper($query1[0]->requested_by));
		$sheet->setCellValue('D'.$rowmerge, strtoupper($query1[0]->approve_by));
		$sheet->setCellValue('F'.$rowmerge, strtoupper($query1[0]->issued_by));
		$sheet->setCellValue('H'.$rowmerge, strtoupper($query1[0]->recieve_by));
		$sheet->getStyle('C'.$rowmerge.':H'.$rowmerge)->applyFromArray($allCell);
		$sheet->getStyle('A'.$rowmerge.':B'.$rowmerge)->applyFromArray($borderThin);
		$sheet->getStyle('A'.$rowmerge.':H'.$rowmerge)->applyFromArray($unitfontbottom2);
		$sheet->getStyle('C'.$rowmerge.':H'.$rowmerge)->getAlignment()->setHorizontal('center');
		$sheet->getStyle('C'.$rowmerge.':H'.$rowmerge)->applyFromArray($signaturefontbottom);

		$rowmerge=(int)$rowmerge+1;
		$sheet->setCellValue('A'.$rowmerge, 'Designation:');
		$sheet->getRowDimension($rowmerge)->setRowHeight(20);
		$sheet->mergeCells('D'.$rowmerge.':E'.$rowmerge);
		$sheet->mergeCells('F'.$rowmerge.':G'.$rowmerge);
		$sheet->setCellValue('C'.$rowmerge, $query1[0]->requested_by_pos);
		$sheet->setCellValue('D'.$rowmerge, $query1[0]->approve_by_pos);
		$sheet->setCellValue('F'.$rowmerge, $query1[0]->issued_by_pos);
		$sheet->setCellValue('H'.$rowmerge, $query1[0]->recieve_by_pos);
		$sheet->getStyle('C'.$rowmerge.':H'.$rowmerge)->applyFromArray($allCell);
		$sheet->getStyle('A'.$rowmerge.':B'.$rowmerge)->applyFromArray($borderThin);
		$sheet->getStyle('A'.$rowmerge.':H'.$rowmerge)->applyFromArray($unitfontbottom2);
		$sheet->getStyle('C'.$rowmerge.':H'.$rowmerge)->getAlignment()->setHorizontal('center');
		$sheet->getStyle('C'.$rowmerge.':H'.$rowmerge)->getAlignment()->setWrapText(true);
		$sheet->getStyle('A'.$rowmerge.':H'.$rowmerge)->getAlignment()->setVertical('top');

		$rowmerge=(int)$rowmerge+1;
		$sheet->setCellValue('A'.$rowmerge, 'Date:');
		$sheet->getRowDimension($rowmerge)->setRowHeight(20);
		$sheet->mergeCells('D'.$rowmerge.':E'.$rowmerge);
		$sheet->mergeCells('F'.$rowmerge.':G'.$rowmerge);
		$sheet->setCellValue('C'.$rowmerge, Carbon::parse($query1[0]->date_request)->format('n/j/Y'));
		$sheet->setCellValue('D'.$rowmerge, Carbon::parse($query1[0]->date_approve)->format('n/j/Y'));
		$sheet->setCellValue('F'.$rowmerge, Carbon::parse($query1[0]->date_issued)->format('n/j/Y'));
		$sheet->setCellValue('H'.$rowmerge, Carbon::parse($query1[0]->date_receive)->format('n/j/Y'));
		$sheet->getStyle('C'.$rowmerge.':H'.$rowmerge)->applyFromArray($allCell);
		$sheet->getStyle('A'.$rowmerge.':B'.$rowmerge)->applyFromArray($borderThin);
		$sheet->getStyle('A'.$rstart.':H'.$rend)->applyFromArray($borderMedium);
		$sheet->getStyle('A'.$rowmerge.':H'.$rowmerge)->applyFromArray($unitfontbottom2);
		$sheet->getStyle('C'.$rowmerge.':H'.$rowmerge)->getAlignment()->setHorizontal('center');

		$sheet->getStyle('A10:H11')->getAlignment()->setHorizontal('center');
		$sheet->getStyle('A4')->getAlignment()->setHorizontal('center');
		$sheet->getStyle('H2')->applyFromArray($appendix);
		$sheet->getStyle('A4:H4')->applyFromArray($headerfont);
		$sheet->getStyle('A6:H6')->applyFromArray($headerfont);
		$sheet->getStyle('A8:H9')->applyFromArray($entityfont);
		$sheet->getStyle('A10:H10')->applyFromArray($unitfonttop);
		$sheet->getStyle('A11:H11')->applyFromArray($unitfontbottom);
		$sheet->getStyle('A8:E9')->applyFromArray($borderMedium);
		$sheet->getStyle('F8:H9')->applyFromArray($borderMedium);
		$sheet->getStyle('A10:H11')->applyFromArray($borderThin);
		$sheet->getStyle('A10:H11')->applyFromArray($borderMedium);
		$sheet->getStyle('A10:H11')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('3b5998');

		$protect = Str::random(10);

		$sheet->getProtection()->setSheet(true);
		$sheet->getProtection()->setSort(true);
		$sheet->getProtection()->setInsertRows(true);
		$sheet->getProtection()->setFormatCells(true);

		$sheet->getProtection()->setPassword($protect);

		$writer = new Xlsx($spreadsheet);
		$writer->save('Requisition and Issue Slip.xlsx');

		$filename="Requisition and Issue Slip.xlsx";
		$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader("Xlsx");
		$spreadsheet = $reader->load("$filename");

		$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Mpdf');

		$pdf_path = 'Requisition and Issue Slip.pdf';
		$writer->save($pdf_path);

		//return redirect('/'.$pdf_path);
		return redirect('/'.$filename);
    }

    public function stock_card($stock,$begin,$end)
    {
    	$reorderdata = DB::table('stock_libs')
                ->join('summaries','summaries.stock_number','stock_libs.stock_code')
                ->where(['summaries.type'=>'iar'])
                ->select(DB::raw('stock_libs.id as id'),DB::raw('stock_libs.stock_code as stock_code'),DB::raw('stock_libs.description as description'),DB::raw('stock_libs.unit as unit'),DB::raw('stock_libs.expense_category as expense_category'),DB::raw('stock_libs.reorderpoint as reorderpoint'),DB::raw('sum(summaries.available) as available'))
                ->groupBy('stock_libs.stock_code')
                ->get();


    	$period = Carbon::parse($begin)->monthsUntil($end);
    	$dateOn = Carbon::now();

    	$pb=0;
    	$pbt=0;
    	$iss=0;
    	$outpt='';
    	$row = 13;

		$r_qty=0;
		$i_qty=0;
		$b_qty=0;
		$u_cost=0;
		$datas='';

    	foreach ($period as $key => $date) {

		    $rpt = $date->format('n-Y');

		    $data = DB::table('summaries')
		    		->where(['summaries.report_date'=>$date->format('n-Y'),'summaries.stock_number'=>$stock])
		    		->get();

		   		foreach ($data as $dat) {
		   			$type = $dat->type;

		   			if($type=='iar'){
		   				$pb = (int)$dat->physical_count;
		   				$pbt = (int)$pbt + (int)$dat->available;
		   			}else{
		   				$pb = (int)$dat->quantity;
		   				$pbt = (int)$pbt - (int)$dat->quantity;
		   			}

		   			$datas=$data;
		   		}
		   		
		}

		
		$date->modify('+1 month');

		$dateForward = Carbon::parse($end)->monthsUntil($dateOn);


		foreach ($dateForward as $key => $date2) {
			
			$summ = DB::table('summaries')
                        ->where(['summaries.stock_number'=>$stock,'summaries.category'=>'StockCard', 'summaries.type'=>'iar'])
                        ->orderBy('summaries.created_at','desc')
                        ->first();
						

		}
		

		/*
		$period = Carbon::parse($begin)->monthsUntil($end);
    	$dateOn = Carbon::now();

    	$pb=0;
        $pcount=0;
    	$outpt='';
        $datas='';
        $row = 13;

    	foreach ($period as $date) {

		    $rpt = $date->format('n-Y');
            
            //echo($date);

		    $data = DB::table('summaries')
		    		->where(['summaries.stock_number'=>$stock, 'summaries.category'=>'StockCard', 'report_date'=>$rpt])
		    		->get();

		   		foreach ($data as $dat) {
		   			$type = $dat->type;

		   			if($type=='iar'){
                        $pb = (int)$dat->physical_count;
		   				//$pb = (int)$pb + (int)$dat->quantity;
                        $pcount = (int)$pcount + (int)$dat->quantity;
                        $pdate = $dat->invoice_date;
		   			}else{
		   				$pb = (int)$dat->quantity;
		   			}

                    $datas=$data;
		   		}
		   		
		}

        $ty='ris';
        $bg = Carbon::parse($begin)->format('n-Y');


        $items = DB::table('summaries')
                        ->where(['summaries.stock_number'=>$stock,'summaries.category'=>'StockCard', 'summaries.type'=>'iar'])
                        ->orderBy('summaries.created_at','desc')
                        ->first();
        */
		
		if(!empty($datas)){

				//return view('stockcard.stock-card-view',compact('pb','summ'));

		$appendix = array(
	    'font'  	=> array(
	        'bold'  => true,
	        'italic'=> true,
	        'color' => array('rgb' => '3b5998'),
	        'size'  => 16,
	        'name'  => 'Times New Roman'
	    ));

        $headerfont = array(
	    'font'  	=> array(
	        'bold'  => true,
	        'color' => array('rgb' => '000000'),
	        'size'  => 12,
	        'name'  => 'Times New Roman'
	    ));


	    $unitfont = array(
	    'font'  	=> array(
	        'bold'  => true,
	        'color' => array('rgb' => 'ffffff'),
	        'size'  => 12,
	        'name'  => 'Times New Roman'
	    ));

	    $borderMedium = array(
		    'borders' => array(
		        'outline' => array(
		            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM,
		            'color' => array('argb' => '000000'),
		        ),
		    ),
		);

		$borderAllMedium = array(
		    'borders' => array(
		        'allBorders' => array(
		            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM,
		            'color' => array('argb' => '000000'),
		        ),
		    ),
		);

		$borderThin = array(
		    'borders' => array(
		        'outline' => array(
		            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
		            'color' => array('argb' => '000000'),
		        ),
		    ),
		);

		$allCell = array(
		      'borders' => array(
		          'allBorders' => array(
		              'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
		              'color' => array('argb' => '000000'),
		          )
		      )
		  );

		$borderHair = array(
		    'borders' => array(
		        'outline' => array(
		            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_HAIR,
		            'color' => array('argb' => '000000'),
		        ),
		    ),
		);

		$riscolor = array(
	    'font'  	=> array(
	        'color' => array('rgb' => 'ff0000'),
	        'size'  => 11
	    ));

        $spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();
		$sheet = $spreadsheet->setActiveSheetIndex(0);
		$sheet = $spreadsheet->getActiveSheet()->setTitle('SC-Admin');

		$sheet->getColumnDimension('A')->setAutoSize(false);
		$sheet->getColumnDimension('A')->setWidth(11.89);
		$sheet->getColumnDimension('B')->setAutoSize(false);
		$sheet->getColumnDimension('B')->setWidth(11.89);
		$sheet->getColumnDimension('C')->setAutoSize(false);
		$sheet->getColumnDimension('C')->setWidth(24.56);
		$sheet->getColumnDimension('D')->setAutoSize(false);
		$sheet->getColumnDimension('D')->setWidth(12.67);
		$sheet->getColumnDimension('E')->setAutoSize(false);
		$sheet->getColumnDimension('E')->setWidth(12.67);
		$sheet->getColumnDimension('F')->setAutoSize(false);
		$sheet->getColumnDimension('F')->setWidth(26.22);
		$sheet->getColumnDimension('G')->setAutoSize(false);
		$sheet->getColumnDimension('G')->setWidth(17.22);
		$sheet->getColumnDimension('H')->setAutoSize(false);
		$sheet->getColumnDimension('H')->setWidth(23.22);
		$sheet->getColumnDimension('I')->setAutoSize(false);
		$sheet->getColumnDimension('I')->setWidth(1.22);
		$sheet->getColumnDimension('J')->setAutoSize(false);
		$sheet->getColumnDimension('J')->setWidth(12.22);
		$sheet->getColumnDimension('K')->setAutoSize(false);
		$sheet->getColumnDimension('K')->setWidth(12.22);

		$sheet->setCellValue('H2', 'Appendix 58');
		$sheet->setCellValue('A5', 'STOCK CARD');
		$sheet->mergeCells('A1:H1');
		$sheet->mergeCells('A2:G2');
		$sheet->mergeCells('A3:H3');
		$sheet->mergeCells('A4:H4');
		$sheet->mergeCells('A5:H5');
		$sheet->mergeCells('A7:F7');
		$sheet->mergeCells('I1:K1');
		$sheet->mergeCells('I2:K2');
		$sheet->mergeCells('I3:K3');
		$sheet->mergeCells('I4:K4');
		$sheet->mergeCells('I5:K5');
		$sheet->mergeCells('I6:K6');
		$sheet->mergeCells('I7:K7');
		$sheet->setCellValue('A7', 'Entity Name: '. $datas[0]->entity_name);
		$sheet->setCellValue('G7', 'Cluster:');
		$sheet->setCellValue('H7', $datas[0]->cluster);
		$sheet->setCellValue('A8', 'Item Name:');
		$sheet->setCellValue('C8', $datas[0]->description);
		$sheet->setCellValue('G8', 'Stock No.:');
		$sheet->setCellValue('H8', $datas[0]->stock_number);
		$sheet->setCellValue('A9', 'Description:');
		$sheet->setCellValue('C9', $datas[0]->description);
		$sheet->setCellValue('G9', 'Re-Order Point:');
		$sheet->setCellValue('H9', $datas[0]->re_order);
		$sheet->setCellValue('A10', 'Unit of Measurement:');
		$sheet->setCellValue('C10', $datas[0]->unit);


		$sheet->setCellValue('A11', 'Date');
		$sheet->mergeCells('A11:A12');
		$sheet->setCellValue('B11', 'Reference');
		$sheet->mergeCells('B11:C12');
		$sheet->setCellValue('D11', 'Receipt');
		$sheet->setCellValue('E11', 'Issue');
		$sheet->setCellValue('D12', 'Qty');
		$sheet->setCellValue('E12', 'Qty');
		$sheet->setCellValue('F12', 'Office');
		$sheet->setCellValue('G12', 'Qty');
		$sheet->mergeCells('E11:F11');
		$sheet->setCellValue('G11', 'Balance');
		$sheet->setCellValue('H11', 'No. of Days to Consume');
		$sheet->mergeCells('H11:H12');
		$sheet->setCellValue('J8', 'UNIT COST');
		$sheet->mergeCells('J8:J12');
		$sheet->setCellValue('K8', 'DIVISION');
		$sheet->mergeCells('K8:K12');
		$sheet->mergeCells('C8:F8');
		$sheet->mergeCells('C9:F9');
		$sheet->mergeCells('C10:F10');
		$sheet->getRowDimension(8)->setRowHeight(20);
		$sheet->getRowDimension(9)->setRowHeight(20);
		$sheet->getRowDimension(10)->setRowHeight(20);
		$sheet->getStyle('A8:H10')->getAlignment()->setVertical('center');

		$sheet->setCellValue('A'.$row, Carbon::parse($datas[0]->created_at)->format('n/j/Y'));
		$sheet->setCellValue('B'.$row,'Physical Count');
		$sheet->getRowDimension($row)->setRowHeight(30);
		$sheet->mergeCells('B'.$row.':C'.$row);
		$sheet->setCellValue('D'.$row, number_format($datas[0]->physical_count, 0, '.', ','));
		$sheet->setCellValue('G'.$row, number_format($datas[0]->physical_count, 0, '.', ','));
		//$sheet->setCellValue('J'.$row, number_format($summ[0]->cost, 0, '.', ','));
		$u_cost = $datas[0]->cost;
		$row+=1;
		foreach ($datas as $i)
		{
			$sheet->setCellValue('A'.$row, Carbon::parse($i->created_at)->format('n/j/Y'));
			
			$sheet->mergeCells('B'.$row.':C'.$row);

			if($i->type=='iar')
			{
				$sheet->setCellValue('B'.$row, 'IAR'.$i->ris_num);
				$sheet->setCellValue('D'.$row, number_format($i->quantity, 0, '.', ','));
				//$sheet->setCellValue('E'.$row, number_format($i->available, 0, '.', ','));

					$pb = $i->quantity + $pb;
					$pbt = (int)$pbt + (int)$i->quantity;
					$u_cost = $u_cost + $i->cost;

				$sheet->setCellValue('G'.$row, number_format($pb, 0, '.', ','));
				$sheet->setCellValue('J'.$row, number_format($i->cost, 0, '.', ','));
			}else{

				$sheet->setCellValue('B'.$row, 'RIS'.$i->ris_num);
				$sheet->setCellValue('E'.$row, number_format($i->quantity, 0, '.', ','));
				$sheet->setCellValue('F'.$row, $i->division);
				//$sheet->setCellValue('E'.$row, number_format($i->available, 0, '.', ','));

				$pb = $pb - $i->quantity;
				$iss = $iss + $i->quantity;

				$sheet->setCellValue('G'.$row, number_format($pb, 0, '.', ','));
				$sheet->setCellValue('H'.$row, $i->consume_days);
				$sheet->getStyle('G'.$row)->applyFromArray($riscolor);
			}
			
			$sheet->getRowDimension($row)->setRowHeight(30);
			$row++;
		}


		$sheet->getStyle('A11:K12')->getAlignment()->setHorizontal('center');
		$sheet->getStyle('A11:K12')->getAlignment()->setVertical('center');
		$sheet->getStyle('A5:H7')->applyFromArray($headerfont);
		$sheet->getStyle('A5:H5')->getAlignment()->setHorizontal('center');
		$sheet->getStyle('A11:H12')->applyFromArray($unitfont);
		$sheet->getStyle('C8:C10')->applyFromArray($headerfont);
		$sheet->getStyle('H8:H10')->applyFromArray($headerfont);
		$sheet->getStyle('J8:K12')->applyFromArray($headerfont);
		$sheet->getStyle('J8:K12')->getAlignment()->setHorizontal('center');
		$sheet->getStyle('J8:K12')->getAlignment()->setVertical('center');
		$sheet->getStyle('H2')->applyFromArray($appendix);
		$sheet->getStyle('A8:H8')->applyFromArray($borderThin);
		$sheet->getStyle('A8:H9')->applyFromArray($borderThin);
		$sheet->getStyle('A8:H10')->applyFromArray($borderThin);
		//$row=(int)$row-1;
		$sheet->setCellValue('A'.$row,'TOTAL');
		$sheet->getStyle('A'.$row.':K'.$row)->applyFromArray($headerfont);
		$sheet->mergeCells('B'.$row.':C'.$row);
		$sheet->getStyle('A13:H'.$row)->applyFromArray($allCell);
		$sheet->getStyle('A13:H'.$row)->applyFromArray($borderMedium);
		$sheet->getStyle('J13:K'.$row)->applyFromArray($allCell);
		$sheet->getStyle('J13:K'.$row)->applyFromArray($borderMedium);
		$sheet->getStyle('A8:F10')->applyFromArray($borderMedium);
		$sheet->getStyle('F8:H10')->applyFromArray($borderMedium);
		$sheet->getStyle('A11:H12')->applyFromArray($borderAllMedium);
		$sheet->getStyle('A11:H12')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('3b5998');
		$sheet->getStyle('J8:J12')->applyFromArray($borderAllMedium);
		$sheet->getStyle('K8:K12')->applyFromArray($borderAllMedium);
		$sheet->getStyle('J8:K12')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('3b5998');
		$sheet->getStyle('J8:K12')->applyFromArray($unitfont);
		$sheet->setCellValue('D'.$row, number_format($pbt, 0, '.', ','));
		$sheet->setCellValue('E'.$row, number_format($iss, 0, '.', ','));
		$b_qty=(int)$pbt-(int)$iss;
		//$sheet->setCellValue('G'.$row, number_format($b_qty, 0, '.', ','));
		$sheet->setCellValue('J'.$row, number_format($u_cost, 2, '.', ','));
		$sheet->getStyle('A'.$row.':H'.$row)->applyFromArray($borderAllMedium);
		$sheet->getStyle('B13:E'.$row)->getAlignment()->setHorizontal('right');
		$sheet->getStyle('G13:H'.$row)->getAlignment()->setHorizontal('right');
		$sheet->getStyle('J'.$row)->getAlignment()->setHorizontal('right');
		$sheet->getStyle('F13:F'.$row)->getAlignment()->setHorizontal('center');
		$sheet->getStyle('A13:J'.$row)->getAlignment()->setVertical('center');
		$sheet->getRowDimension($row)->setRowHeight(30);

		$protect = Str::random(10);

		$sheet->getProtection()->setSheet(true);
		$sheet->getProtection()->setSort(true);
		$sheet->getProtection()->setInsertRows(true);
		$sheet->getProtection()->setFormatCells(true);

		$sheet->getProtection()->setPassword($protect);

		//$sheet = $spreadsheet->createSheet();
		//$sheet = $spreadsheet->setActiveSheetIndex(1);
		//$sheet = $spreadsheet->getActiveSheet()->setTitle('Stock Card - Finance');


		$writer = new Xlsx($spreadsheet);
		$writer->save('Stock Card.xlsx');

		$filename="Stock Card.xlsx";
		$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader("Xlsx");
		$spreadsheet = $reader->load("$filename");

		$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Mpdf');

		$pdf_path = 'Stock Card.pdf';
		$writer->save($pdf_path);

		//return redirect('/'.$pdf_path);
		return redirect('/'.$filename);

				
			}else{
				return view('stockcard.error-404',compact('reorderdata'));
			}
		
    }

    public function stock_card_finance($stock,$begin,$end)
    {

    	$reorderdata = DB::table('stock_libs')
                ->join('summaries','summaries.stock_number','stock_libs.stock_code')
                ->where(['summaries.type'=>'iar'])
                ->select(DB::raw('stock_libs.id as id'),DB::raw('stock_libs.stock_code as stock_code'),DB::raw('stock_libs.description as description'),DB::raw('stock_libs.unit as unit'),DB::raw('stock_libs.expense_category as expense_category'),DB::raw('stock_libs.reorderpoint as reorderpoint'),DB::raw('sum(summaries.available) as available'))
                ->groupBy('stock_libs.stock_code')
                ->get();

    	$period = Carbon::parse($begin)->monthsUntil($end);
    	$dateOn = Carbon::now();

    	$pb=0;
    	$pbt=0;
    	$iss=0;
    	$outpt='';
    	$row = 13;
    	$counter = 1;

		$r_qty=0;
		$i_qty=0;
		$b_qty=0;
		$u_cost=0;
		$pcount=0;
		$updatecost=0;
		$updateruncost=0;

		$receiptqty=0;
		$issueqty=0;
		$balanceqty=0;
		$datas='';

		/*
		$datas='';

    	foreach ($period as $key => $date) {

		    $rpt = $date->format('n-Y');

		    $data = DB::table('summaries')
		    		->where(['summaries.report_date'=>$date->format('n-Y'),'summaries.stock_number'=>$stock])
		    		->get();

		   		foreach ($data as $dat) {
		   			$type = $dat->type;

		   			if($type=='iar'){
		   				$pb = (int)$dat->physical_count;
		   				$pbt = (int)$pbt + (int)$dat->available;
		   			}else{
		   				$pb = (int)$dat->quantity;
		   				$pbt = (int)$pbt - (int)$dat->quantity;
		   			}

		   			$datas=$data;
		   		}
		   		
		}


		*/

    	foreach ($period as $key => $date) {

		    $rpt = $date->format('n-Y');

		    $data = DB::table('summaries')
		    		->where(['summaries.report_date'=>$date->format('n-Y'),'summaries.stock_number'=>$stock])
		    		->get();

		   		foreach ($data as $dat) {
		   			$type = $dat->type;

		   			if($type=='iar'){
		   				$pb = (int)$dat->physical_count;
		   				$pbt = (int)$pbt + (int)$dat->available;
		   				$pcount=(int)$pcount + (int)$dat->quantity;
		   				$pdate = $dat->invoice_date;
		   			}else{
		   				$pb = (int)$dat->quantity;
		   				$pbt = (int)$pbt - (int)$dat->quantity;
		   			}

		   			$datas=$data;
		   		}
		   		
		}

		
		$date->modify('+1 month');

		$dateForward = Carbon::parse($end)->monthsUntil($dateOn);


		foreach ($dateForward as $key => $date2) {
			
			$summ = DB::table('summaries')
						->where(['summaries.report_date'=>$date2->format('n-Y'),'summaries.stock_number'=>$stock])
						->orderBy('summaries.created_at','asc')
						->get();
						

		}

		
		if(!empty($datas)){

		$appendix = array(
	    'font'  	=> array(
	        'bold'  => true,
	        'italic'=> true,
	        'color' => array('rgb' => '3b5998'),
	        'size'  => 16,
	        'name'  => 'Times New Roman'
	    ));

        $headerfont = array(
	    'font'  	=> array(
	        'bold'  => true,
	        'color' => array('rgb' => '000000'),
	        'size'  => 12,
	        'name'  => 'Times New Roman'
	    ));


	    $unitfont = array(
	    'font'  	=> array(
	        'bold'  => true,
	        'color' => array('rgb' => 'ffffff'),
	        'size'  => 12,
	        'name'  => 'Times New Roman'
	    ));

	    $borderMedium = array(
		    'borders' => array(
		        'outline' => array(
		            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM,
		            'color' => array('argb' => '000000'),
		        ),
		    ),
		);

		$borderAllMedium = array(
		    'borders' => array(
		        'allBorders' => array(
		            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM,
		            'color' => array('argb' => '000000'),
		        ),
		    ),
		);

		$borderThin = array(
		    'borders' => array(
		        'outline' => array(
		            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
		            'color' => array('argb' => '000000'),
		        ),
		    ),
		);

		$allCell = array(
		      'borders' => array(
		          'allBorders' => array(
		              'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
		              'color' => array('argb' => '000000'),
		          )
		      )
		  );

		$borderHair = array(
		    'borders' => array(
		        'outline' => array(
		            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_HAIR,
		            'color' => array('argb' => '000000'),
		        ),
		    ),
		);

		$riscolor = array(
	    'font'  	=> array(
	        'color' => array('rgb' => 'ff0000'),
	        'size'  => 11
	    ));

	    	$spreadsheet = new Spreadsheet();
			$sheet = $spreadsheet->getActiveSheet();
			$sheet = $spreadsheet->setActiveSheetIndex(0);
			$sheet = $spreadsheet->getActiveSheet()->setTitle('SC-Finance');

			$sheet->getColumnDimension('A')->setAutoSize(false);
			$sheet->getColumnDimension('A')->setWidth(11.89);
			$sheet->getColumnDimension('B')->setAutoSize(false);
			$sheet->getColumnDimension('B')->setWidth(15.56);
			$sheet->getColumnDimension('C')->setAutoSize(false);
			$sheet->getColumnDimension('C')->setWidth(12.67);
			$sheet->getColumnDimension('D')->setAutoSize(false);
			$sheet->getColumnDimension('D')->setWidth(12.67);
			$sheet->getColumnDimension('E')->setAutoSize(false);
			$sheet->getColumnDimension('E')->setWidth(12.67);
			$sheet->getColumnDimension('F')->setAutoSize(false);
			$sheet->getColumnDimension('F')->setWidth(12.67);
			$sheet->getColumnDimension('G')->setAutoSize(false);
			$sheet->getColumnDimension('G')->setWidth(12.67);
			$sheet->getColumnDimension('H')->setAutoSize(false);
			$sheet->getColumnDimension('H')->setWidth(12.67);
			$sheet->getColumnDimension('I')->setAutoSize(false);
			$sheet->getColumnDimension('I')->setWidth(12.67);
			$sheet->getColumnDimension('J')->setAutoSize(false);
			$sheet->getColumnDimension('J')->setWidth(12.67);
			$sheet->getColumnDimension('K')->setAutoSize(false);
			$sheet->getColumnDimension('K')->setWidth(15.56);
			$sheet->getColumnDimension('L')->setAutoSize(false);
			$sheet->getColumnDimension('L')->setWidth(13.67);

			$sheet->setCellValue('J2', 'Appendix 58');
			$sheet->setCellValue('A5', 'STOCK CARD');
			$sheet->mergeCells('A5:L5');
			$sheet->getStyle('A5:L5')->getAlignment()->setHorizontal('center');
			$sheet->getStyle('A5:L5')->getAlignment()->setVertical('center');

			$sheet->setCellValue('A7', 'Entity Name: '. $datas[0]->entity_name);
			$sheet->setCellValue('J7', 'Cluster:');
			$sheet->setCellValue('L7', $datas[0]->cluster);
			$sheet->setCellValue('A8', 'Item Name:');
			$sheet->setCellValue('C8', $datas[0]->description);
			$sheet->setCellValue('J8', 'Stock No.:');
			$sheet->setCellValue('L8', $datas[0]->stock_number);
			$sheet->setCellValue('A9', 'Description:');
			$sheet->setCellValue('C9', $datas[0]->description);
			$sheet->setCellValue('J9', 'Re-Order Point:');
			$sheet->setCellValue('L9', $datas[0]->re_order);
			$sheet->setCellValue('A10', 'Unit of Measurement:');
			$sheet->setCellValue('C10', $datas[0]->unit);

			$sheet->setCellValue('A11', 'Date');
			$sheet->mergeCells('A11:A12');
			$sheet->setCellValue('B11', 'Reference');
			$sheet->mergeCells('B11:B12');
			$sheet->setCellValue('C11','Receipt');
			$sheet->mergeCells('C11:E11');
			$sheet->setCellValue('C12','Qty');
			$sheet->setCellValue('D12','Price/Unit');
			$sheet->setCellValue('E12','Total');
			$sheet->setCellValue('F11','Issue');
			$sheet->mergeCells('F11:I11');
			$sheet->setCellValue('F12','Qty');
			$sheet->setCellValue('G12','Price/Unit');
			$sheet->setCellValue('H12','Total');
			$sheet->setCellValue('I12','Office');
			$sheet->setCellValue('J11','Balance');
			$sheet->setCellValue('J12','Qty');
			$sheet->setCellValue('K12','Ave. Price/Unit');
			$sheet->setCellValue('L12','Total Amount');
			$sheet->mergeCells('J11:L11');

			$sheet->getRowDimension(8)->setRowHeight(20);
			$sheet->getRowDimension(9)->setRowHeight(20);
			$sheet->getRowDimension(10)->setRowHeight(20);
			$sheet->getStyle('A11:L12')->getAlignment()->setHorizontal('center');
			$sheet->getStyle('A1:L12')->getAlignment()->setVertical('center');

			
			$sheet->setCellValue('A'.$row, Carbon::parse($pdate)->format('n/j/Y'));
			$sheet->setCellValue('B'.$row,'Physical Count');
			$sheet->getRowDimension($row)->setRowHeight(30);
			$sheet->setCellValue('C'.$row, number_format($datas[0]->physical_count, 0, '.', ','));

			$sheet->getStyle('E'.$row)->getNumberFormat()->setFormatCode('###,###,##0.00');
			$sheet->getCell('E'.$row)
			    ->setValueExplicit(
			        $datas[0]->cost,
			        \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_NUMERIC
			    );

			$sheet->setCellValue('J'.$row, number_format($datas[0]->physical_count, 0, '.', ','));

			$tpc = (int)$datas[0]->cost * (int)$datas[0]->physical_count;

			$sheet->getStyle('L'.$row)->getNumberFormat()->setFormatCode('###,###,##0.00');
			$sheet->getCell('L'.$row)
			    ->setValueExplicit(
			        $tpc,
			        \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_NUMERIC
			    );

			    
			if($datas[0]->physical_count>0){
				$averagecost = $datas[0]->cost / $datas[0]->physical_count;
			}else{
				$averagecost=0;
			}
			$updatecost = $datas[0]->cost / $pcount;
			$runcost = $datas[0]->cost;

			$sheet->getStyle('K'.$row)->getNumberFormat()->setFormatCode('###,###,##0.00');
			$sheet->getCell('K'.$row)
			    ->setValueExplicit(
			        $averagecost,
			        \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_NUMERIC
			    );

			$sheet->getStyle('D'.$row)->getNumberFormat()->setFormatCode('###,###,##0.00');
			$sheet->getCell('D'.$row)
			    ->setValueExplicit(
			        $averagecost,
			        \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_NUMERIC
			    );

			$balanceqty = (int)$balanceqty+(int)$pcount;
			$receiptqty=(int)$receiptqty+(int)$pcount;
			$u_cost = $datas[0]->cost;
			$row+=1;
			foreach ($datas as $i)
			{
				

				if($i->type=='iar')
				{
					$sheet->setCellValue('A'.$row, Carbon::parse($i->invoice_date)->format('n/j/Y'));
					$sheet->setCellValue('B'.$row, 'IAR'.$i->ris_num);
					$sheet->setCellValue('C'.$row, number_format($i->quantity, 0, '.', ','));
					//$sheet->setCellValue('D'.$row, number_format($i->cost, 0, '.', ','));

						$pb = $i->quantity + $pb;
						$pbt = (int)$pbt + (int)$i->quantity;
						$u_cost = $u_cost + $i->cost;

					$newqty = (int)$i->quantity;

					$sheet->setCellValue('J'.$row, $newqty);

					$pcount = $newqty;

					$iarprice = $i->cost / $i->quantity;

					$sheet->getStyle('D'.$row)->getNumberFormat()->setFormatCode('###,###,##0.00');
					$sheet->getCell('D'.$row)
					    ->setValueExplicit(
					        $iarprice,
					        \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_NUMERIC
					    );

					//$sheet->setCellValue('E'.$row, number_format($i->cost, 0, '.', ','));
					$sheet->getStyle('E'.$row)->getNumberFormat()->setFormatCode('###,###,##0.00');
					$sheet->getCell('E'.$row)
					    ->setValueExplicit(
					        $i->cost,
					        \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_NUMERIC
					    );

					$sheet->getStyle('L'.$row)->getNumberFormat()->setFormatCode('###,###,##0.00');
					$sheet->getCell('L'.$row)
					    ->setValueExplicit(
					        (int)$i->cost + (int)$updateruncost,
					        \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_NUMERIC
					    );
	
					$a = (int)$i->cost + (int)$updateruncost;
					$b = (int)$newqty;

					if($b > 0){
						$c = (int)$a/$b;
						$updatecost=$c;

						$sheet->getStyle('K'.$row)->getNumberFormat()->setFormatCode('###,###,##0.00');
						$sheet->getCell('K'.$row)
						    ->setValueExplicit(
						        $c,
						        \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_NUMERIC
						    );
					}else{
						$sheet->getStyle('K'.$row)->getNumberFormat()->setFormatCode('###,###,##0.00');
						$sheet->getCell('K'.$row)
						    ->setValueExplicit(
						        '0.00',
						        \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_NUMERIC
						    );
					}


					//$sheet->setCellValue('M'.$row,$updateruncost);
					$balanceqty = (int)$balanceqty+(int)$newqty;

					$pcount = $updatecost;
					$updateruncost = (int)$i->cost + (int)$updateruncost;

					$receiptqty=(int)$receiptqty+(int)$i->quantity;
				}else{
					$sheet->setCellValue('A'.$row, Carbon::parse($i->invoice_date)->format('n/j/Y'));
					$sheet->setCellValue('B'.$row, 'RIS'.$i->ris_num);
					$sheet->setCellValue('F'.$row, number_format($i->quantity, 0, '.', ','));
					//$sheet->setCellValue('H'.$row, number_format($i->cost, 0, '.', ','));

					$issueqty = (int)$issueqty+(int)$i->quantity;
					if($counter==1)
					{
						$issuetotal = (int)$i->quantity * (int)$updatecost;
						$totalcost = $i->cost - $issuetotal;

						$sheet->getStyle('G'.$row)->getNumberFormat()->setFormatCode('###,###,##0.00');
						$sheet->getCell('G'.$row)
					    ->setValueExplicit(
					        $updatecost,
					        \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_NUMERIC
					    );

						$sheet->getStyle('H'.$row)->getNumberFormat()->setFormatCode('###,###,##0.00');
						$sheet->getCell('H'.$row)
					    ->setValueExplicit(
					        $issuetotal,
					        \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_NUMERIC
					    );

					    $sheet->getStyle('L'.$row)->getNumberFormat()->setFormatCode('###,###,##0.00');
						$sheet->getCell('L'.$row)
						    ->setValueExplicit(
						        $totalcost,
						        \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_NUMERIC
						    );

						$newqty = (int)$pcount - (int)$i->quantity;

						$calc = (int)$i->cost - (int)$issuetotal;

						$sheet->getStyle('K'.$row)->getNumberFormat()->setFormatCode('###,###,##0.00');
						$sheet->getCell('K'.$row)
						    ->setValueExplicit(
						        (int)$calc/(int)$newqty,
						        \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_NUMERIC
						    );

						$updatecost = $calc/(int)$newqty;

						    //$sheet->setCellValue('M'.$row,$updatecost);
					}else{
						$issuetotal=$updateruncost-$updatecost;
						$totalcost = $issuetotal;

						$worksheet = $spreadsheet->getActiveSheet(); 

						$gtval = $worksheet->getCellByColumnAndRow(11, $row-1)->getValue();

						$sheet->getStyle('G'.$row)->getNumberFormat()->setFormatCode('###,###,##0.00');
						$sheet->getCell('G'.$row)
						    ->setValueExplicit(
						        $gtval,
						        \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_NUMERIC
						    );

						$sheet->getStyle('H'.$row)->getNumberFormat()->setFormatCode('###,###,##0.00');
						$sheet->getCell('H'.$row)
					    ->setValueExplicit(
					        $gtval * $i->quantity,
					        \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_NUMERIC
					    );

					    $gttotalval = $worksheet->getCellByColumnAndRow(12, $row-1)->getValue();

					    $sheet->getStyle('L'.$row)->getNumberFormat()->setFormatCode('###,###,##0.00');
						$sheet->getCell('L'.$row)
						    ->setValueExplicit(
						        $gttotalval- ($gtval * $i->quantity),
						        \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_NUMERIC
						    );

						$newqty = (int)$pcount - (int)$i->quantity;
						
						$calc = $updateruncost-($updatecost*$i->quantity);

						$sheet->getStyle('K'.$row)->getNumberFormat()->setFormatCode('###,###,##0.00');
						$sheet->getCell('K'.$row)
						    ->setValueExplicit(
						        (int)($gttotalval- ($gtval * $i->quantity))/(int)$newqty,
						        \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_NUMERIC
						    );

						

						$updatecost = $calc/(int)$newqty;
						

						    //$sheet->setCellValue('M'.$row,'->'.$updatecost);
					}

					
					$sheet->setCellValue('I'.$row, $i->division);

					$sheet->setCellValue('J'.$row, $newqty);

					$balanceqty = (int)$balanceqty+(int)$newqty;
					$pcount = $newqty;

					$updatecost = (int)$i->cost / (int)$i->quantity;
					$updateruncost=(int)$i->cost - (int)$issuetotal;

					$pb = $pb - $i->quantity;
					$iss = $iss + $i->quantity;

					//$sheet->getStyle('G'.$row)->applyFromArray($riscolor);
				}
				
				$sheet->getRowDimension($row)->setRowHeight(30);
				$row++;
				$counter++;
			}

			$sheet->getStyle('A11:K12')->getAlignment()->setHorizontal('center');
			$sheet->getStyle('A11:K12')->getAlignment()->setVertical('center');
			$sheet->getStyle('A5:L7')->applyFromArray($headerfont);
			$sheet->getStyle('A5:L5')->getAlignment()->setHorizontal('center');
			$sheet->getStyle('A11:L12')->applyFromArray($unitfont);
			$sheet->getStyle('A11:L12')->applyFromArray($borderAllMedium);
			$sheet->getStyle('A11:L12')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('3b5998');
			$sheet->getStyle('C8:C10')->applyFromArray($headerfont);
			$sheet->getStyle('A13:L'.$row)->applyFromArray($allCell);

			$sheet->getStyle('H2')->applyFromArray($appendix);
			$sheet->getStyle('A8:L8')->applyFromArray($borderThin);
			$sheet->getStyle('A8:L9')->applyFromArray($borderThin);
			$sheet->getStyle('A8:L10')->applyFromArray($borderThin);
			$sheet->setCellValue('A'.$row,'TOTAL');
			$sheet->getStyle('A'.$row.':L'.$row)->applyFromArray($headerfont);
			$sheet->getStyle('A'.$row.':L'.$row)->applyFromArray($borderAllMedium);

			$sheet->getStyle('A13:L'.$row)->getAlignment()->setVertical('center');
			$sheet->setCellValue('J'.$row,$balanceqty);
			$sheet->setCellValue('F'.$row,$issueqty);
			$sheet->setCellValue('C'.$row,$receiptqty);
			$sheet->getStyle('J2')->applyFromArray($appendix);

			$protect = Str::random(10);

			$sheet->getProtection()->setSheet(true);
			$sheet->getProtection()->setSort(true);
			$sheet->getProtection()->setInsertRows(true);
			$sheet->getProtection()->setFormatCells(true);

			$sheet->getProtection()->setPassword($protect);

			$writer = new Xlsx($spreadsheet);
			$writer->save('Stock Card Finance.xlsx');

			$filename="Stock Card Finance.xlsx";
			$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader("Xlsx");
			$spreadsheet = $reader->load("$filename");

			$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Mpdf');

			$pdf_path = 'Stock Card Finance.pdf';
			$writer->save($pdf_path);

			//return redirect('/'.$pdf_path);
			return redirect('/'.$filename);

		}else{
			return view('stockcard.error-404',compact('reorderdata'));
		}
    }

    public function property_card($stock,$begin,$end)
    {
    	$period = Carbon::parse($begin)->monthsUntil($end);
    	$dateOn = Carbon::now();

    	$pb=0;
    	$pbt=0;
    	$iss=0;
    	$outpt='';
    	$row = 13;

		$r_qty=0;
		$i_qty=0;
		$b_qty=0;
		$u_cost=0;

    	foreach ($period as $key => $date) {

		    $rpt = $date->format('n-Y');

		    $data = DB::table('summaries')
		    		->where(['summaries.report_date'=>$date->format('n-Y'),'summaries.stock_number'=>$stock])
		    		->get();

		   		foreach ($data as $dat) {
		   			$type = $dat->type;

		   			if($type=='iar'){
		   				$pb = (int)$pb + (int)$dat->available;
		   				$pbt = (int)$pbt + (int)$dat->available;
		   			}else{
		   				$pb = (int)$pb - (int)$dat->quantity;
		   				$pbt = (int)$pbt - (int)$dat->quantity;
		   			}

		   		}
		   		
		}

		
		$date->modify('+1 month');

		$dateForward = Carbon::parse($end)->monthsUntil($dateOn);


		foreach ($dateForward as $key => $date2) {
			
			$summ = DB::table('summaries')
						->where(['summaries.report_date'=>$date2->format('n-Y'),'summaries.stock_number'=>$stock])
						->orderBy('summaries.created_at','asc')
						->get();
						

		}

		//dd($summ);
		if(!empty($summ)){

		

		$appendix = array(
	    'font'  	=> array(
	        'bold'  => true,
	        'italic'=> true,
	        'color' => array('rgb' => '3b5998'),
	        'size'  => 16,
	        'name'  => 'Times New Roman'
	    ));

        $headerfont = array(
	    'font'  	=> array(
	        'bold'  => true,
	        'color' => array('rgb' => '000000'),
	        'size'  => 12,
	        'name'  => 'Times New Roman'
	    ));


	    $unitfont = array(
	    'font'  	=> array(
	        'bold'  => true,
	        'color' => array('rgb' => 'ffffff'),
	        'size'  => 12,
	        'name'  => 'Times New Roman'
	    ));

	    $borderMedium = array(
		    'borders' => array(
		        'outline' => array(
		            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM,
		            'color' => array('argb' => '000000'),
		        ),
		    ),
		);

		$borderAllMedium = array(
		    'borders' => array(
		        'allBorders' => array(
		            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM,
		            'color' => array('argb' => '000000'),
		        ),
		    ),
		);

		$borderThin = array(
		    'borders' => array(
		        'outline' => array(
		            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
		            'color' => array('argb' => '000000'),
		        ),
		    ),
		);

		$allCell = array(
		      'borders' => array(
		          'allBorders' => array(
		              'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
		              'color' => array('argb' => '000000'),
		          )
		      )
		  );

		$borderHair = array(
		    'borders' => array(
		        'outline' => array(
		            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_HAIR,
		            'color' => array('argb' => '000000'),
		        ),
		    ),
		);

		$riscolor = array(
	    'font'  	=> array(
	        'color' => array('rgb' => 'ff0000'),
	        'size'  => 11
	    ));

        $spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();
		$sheet = $spreadsheet->getActiveSheet()->setTitle('Property-Admin');

		$sheet->getColumnDimension('A')->setAutoSize(false);
		$sheet->getColumnDimension('A')->setWidth(11.89);
		$sheet->getColumnDimension('B')->setAutoSize(false);
		$sheet->getColumnDimension('B')->setWidth(11.89);
		$sheet->getColumnDimension('C')->setAutoSize(false);
		$sheet->getColumnDimension('C')->setWidth(24.56);
		$sheet->getColumnDimension('D')->setAutoSize(false);
		$sheet->getColumnDimension('D')->setWidth(12.67);
		$sheet->getColumnDimension('E')->setAutoSize(false);
		$sheet->getColumnDimension('E')->setWidth(12.67);
		$sheet->getColumnDimension('F')->setAutoSize(false);
		$sheet->getColumnDimension('F')->setWidth(26.22);
		$sheet->getColumnDimension('G')->setAutoSize(false);
		$sheet->getColumnDimension('G')->setWidth(17.22);
		$sheet->getColumnDimension('H')->setAutoSize(false);
		$sheet->getColumnDimension('H')->setWidth(23.22);
		$sheet->getColumnDimension('I')->setAutoSize(false);
		$sheet->getColumnDimension('I')->setWidth(1.22);
		$sheet->getColumnDimension('J')->setAutoSize(false);
		$sheet->getColumnDimension('J')->setWidth(12.22);
		$sheet->getColumnDimension('K')->setAutoSize(false);
		$sheet->getColumnDimension('K')->setWidth(12.22);

		$sheet->setCellValue('H2', 'Appendix 58');
		$sheet->setCellValue('A5', 'PROPERTY CARD');
		$sheet->mergeCells('A1:H1');
		$sheet->mergeCells('A2:G2');
		$sheet->mergeCells('A3:H3');
		$sheet->mergeCells('A4:H4');
		$sheet->mergeCells('A5:H5');
		$sheet->mergeCells('A7:F7');
		$sheet->mergeCells('I1:K1');
		$sheet->mergeCells('I2:K2');
		$sheet->mergeCells('I3:K3');
		$sheet->mergeCells('I4:K4');
		$sheet->mergeCells('I5:K5');
		$sheet->mergeCells('I6:K6');
		$sheet->mergeCells('I7:K7');
		$sheet->setCellValue('A7', 'Entity Name: '. $summ[0]->entity_name);
		$sheet->setCellValue('G7', 'Cluster:');
		$sheet->setCellValue('H7', $summ[0]->cluster);
		$sheet->setCellValue('A8', 'Item Name:');
		$sheet->setCellValue('C8', $summ[0]->description);
		$sheet->setCellValue('G8', 'Stock No.:');
		$sheet->setCellValue('H8', $summ[0]->stock_number);
		$sheet->setCellValue('A9', 'Description:');
		$sheet->setCellValue('C9', $summ[0]->description);
		$sheet->setCellValue('G9', 'Re-Order Point:');
		$sheet->setCellValue('H9', $summ[0]->re_order);
		$sheet->setCellValue('A10', 'Unit of Measurement:');
		$sheet->setCellValue('C10', $summ[0]->unit);


		$sheet->setCellValue('A11', 'Date');
		$sheet->mergeCells('A11:A12');
		$sheet->setCellValue('B11', 'Reference');
		$sheet->mergeCells('B11:C12');
		$sheet->setCellValue('D11', 'Receipt');
		$sheet->setCellValue('E11', 'Issue/Transfer/ Disposal');
		$sheet->setCellValue('D12', 'Qty');
		$sheet->setCellValue('E12', 'Qty');
		$sheet->setCellValue('F12', 'Office');
		$sheet->setCellValue('G12', 'Qty');
		$sheet->mergeCells('E11:F11');
		$sheet->setCellValue('G11', 'Balance');
		$sheet->setCellValue('H11', 'No. of Days to Consume');
		$sheet->mergeCells('H11:H12');
		$sheet->setCellValue('J8', 'UNIT COST');
		$sheet->mergeCells('J8:J12');
		$sheet->setCellValue('K8', 'DIVISION');
		$sheet->mergeCells('K8:K12');
		$sheet->mergeCells('C8:F8');
		$sheet->mergeCells('C9:F9');
		$sheet->mergeCells('C10:F10');
		$sheet->getRowDimension(8)->setRowHeight(20);
		$sheet->getRowDimension(9)->setRowHeight(20);
		$sheet->getRowDimension(10)->setRowHeight(20);
		$sheet->getStyle('A8:H10')->getAlignment()->setVertical('center');

		$sheet->setCellValue('A'.$row, Carbon::parse($summ[0]->created_at)->format('n/j/Y'));
		$sheet->setCellValue('B'.$row,'Physical Count');
		$sheet->getRowDimension($row)->setRowHeight(30);
		$sheet->mergeCells('B'.$row.':C'.$row);
		$sheet->setCellValue('D'.$row, number_format($pb, 0, '.', ','));
		//$sheet->setCellValue('G'.$row, number_format($pb, 0, '.', ','));
		//$sheet->setCellValue('J'.$row, number_format($summ[0]->cost, 0, '.', ','));
		$u_cost = $summ[0]->cost;
		$row+=1;


		foreach ($summ as $i)
		{
			$sheet->setCellValue('A'.$row, Carbon::parse($i->created_at)->format('n/j/Y'));
			
			$sheet->mergeCells('B'.$row.':C'.$row);

			if($i->type=='iar')
			{
				$sheet->setCellValue('B'.$row, 'IAR'.$i->ris_num);
				$sheet->setCellValue('D'.$row, number_format($i->quantity, 0, '.', ','));
				//$sheet->setCellValue('E'.$row, number_format($i->available, 0, '.', ','));

					$pb = $i->quantity + $pb;
					$pbt = (int)$pbt + (int)$i->quantity;
					$u_cost = $u_cost + $i->cost;

				$sheet->setCellValue('G'.$row, number_format($pb, 0, '.', ','));
				//$sheet->setCellValue('J'.$row, number_format($i->cost, 0, '.', ','));
			}else{

				$sheet->setCellValue('B'.$row, 'RIS'.$i->ris_num);
				$sheet->setCellValue('E'.$row, number_format($i->quantity, 0, '.', ','));
				$sheet->setCellValue('F'.$row, $i->division);
				//$sheet->setCellValue('E'.$row, number_format($i->available, 0, '.', ','));

				$pb = $pb - $i->quantity;
				$iss = $iss + $i->quantity;

				$sheet->setCellValue('G'.$row, number_format($pb, 0, '.', ','));
				$sheet->setCellValue('H'.$row, $i->consume_days);
				$sheet->getStyle('G'.$row)->applyFromArray($riscolor);
			}
			
			
			$sheet->getRowDimension($row)->setRowHeight(30);
			$row++;
		}



		$sheet->getStyle('A11:K12')->getAlignment()->setHorizontal('center');
		$sheet->getStyle('A11:K12')->getAlignment()->setVertical('center');
		$sheet->getStyle('A5:H7')->applyFromArray($headerfont);
		$sheet->getStyle('A5:H5')->getAlignment()->setHorizontal('center');
		$sheet->getStyle('A11:H12')->applyFromArray($unitfont);
		$sheet->getStyle('C8:C10')->applyFromArray($headerfont);
		$sheet->getStyle('H8:H10')->applyFromArray($headerfont);
		$sheet->getStyle('J8:K12')->applyFromArray($headerfont);
		$sheet->getStyle('J8:K12')->getAlignment()->setHorizontal('center');
		$sheet->getStyle('J8:K12')->getAlignment()->setVertical('center');
		$sheet->getStyle('H2')->applyFromArray($appendix);
		$sheet->getStyle('A8:H8')->applyFromArray($borderThin);
		$sheet->getStyle('A8:H9')->applyFromArray($borderThin);
		$sheet->getStyle('A8:H10')->applyFromArray($borderThin);
		//$row=(int)$row-1;
		$sheet->setCellValue('A'.$row,'TOTAL');
		$sheet->getStyle('A'.$row.':K'.$row)->applyFromArray($headerfont);
		$sheet->mergeCells('B'.$row.':C'.$row);
		$sheet->getStyle('A13:H'.$row)->applyFromArray($allCell);
		$sheet->getStyle('A13:H'.$row)->applyFromArray($borderMedium);
		$sheet->getStyle('J13:K'.$row)->applyFromArray($allCell);
		$sheet->getStyle('J13:K'.$row)->applyFromArray($borderMedium);
		$sheet->getStyle('A8:F10')->applyFromArray($borderMedium);
		$sheet->getStyle('F8:H10')->applyFromArray($borderMedium);
		$sheet->getStyle('A11:H12')->applyFromArray($borderAllMedium);
		$sheet->getStyle('A11:H12')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('3b5998');
		$sheet->getStyle('J8:J12')->applyFromArray($borderAllMedium);
		$sheet->getStyle('K8:K12')->applyFromArray($borderAllMedium);
		$sheet->getStyle('J8:K12')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('3b5998');
		$sheet->getStyle('J8:K12')->applyFromArray($unitfont);
		$sheet->setCellValue('D'.$row, number_format($pbt, 0, '.', ','));
		$sheet->setCellValue('E'.$row, number_format($iss, 0, '.', ','));
		$b_qty=(int)$pbt-(int)$iss;
		$sheet->setCellValue('G'.$row, number_format($b_qty, 0, '.', ','));
		//$sheet->setCellValue('J'.$row, number_format($u_cost, 2, '.', ','));
		$sheet->getStyle('A'.$row.':H'.$row)->applyFromArray($borderAllMedium);
		$sheet->getStyle('B13:E'.$row)->getAlignment()->setHorizontal('right');
		$sheet->getStyle('G13:H'.$row)->getAlignment()->setHorizontal('right');
		$sheet->getStyle('J'.$row)->getAlignment()->setHorizontal('right');
		$sheet->getStyle('F13:F'.$row)->getAlignment()->setHorizontal('center');
		$sheet->getStyle('A13:J'.$row)->getAlignment()->setVertical('center');
		$sheet->getRowDimension($row)->setRowHeight(30);

		$protect = Str::random(10);

		$sheet->getProtection()->setSheet(true);
		$sheet->getProtection()->setSort(true);
		$sheet->getProtection()->setInsertRows(true);
		$sheet->getProtection()->setFormatCells(true);

		$sheet->getProtection()->setPassword($protect);

		$writer = new Xlsx($spreadsheet);
		$writer->save('Property Card.xlsx');

		$filename="Property Card.xlsx";
		$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader("Xlsx");
		$spreadsheet = $reader->load("$filename");

		$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Mpdf');

		$pdf_path = 'Property Card.pdf';
		$writer->save($pdf_path);

		//return redirect('/'.$pdf_path);
		return redirect('/'.$filename);

				
			}else{
				return view('stockcard.error-404');
			}
		
    }

public function property_card_finance($stock,$begin,$end)
    {
    	$period = Carbon::parse($begin)->monthsUntil($end);
    	$dateOn = Carbon::now();

    	$pb=0;
    	$pbt=0;
    	$iss=0;
    	$outpt='';
    	$row = 13;
    	$counter = 1;

		$r_qty=0;
		$i_qty=0;
		$b_qty=0;
		$u_cost=0;
		$pcount=0;
		$updatecost=0;
		$updateruncost=0;

		$receiptqty=0;
		$issueqty=0;
		$balanceqty=0;
		$pdate='';

    	foreach ($period as $key => $date) {

		    $rpt = $date->format('n-Y');

		    $data = DB::table('summaries')
		    		->where(['summaries.report_date'=>$date->format('n-Y'),'summaries.stock_number'=>$stock])
		    		->get();

		   		foreach ($data as $dat) {
		   			$type = $dat->type;

		   			if($type=='iar'){
		   				$pb = (int)$pb + (int)$dat->available;
		   				$pbt = (int)$pbt + (int)$dat->available;
		   				$pcount=(int)$pcount + (int)$dat->quantity;
		   				$pdate = $dat->invoice_date;
		   			}else{
		   				$pb = (int)$pb - (int)$dat->quantity;
		   				$pbt = (int)$pbt - (int)$dat->quantity;
		   			}

		   		}
		   		
		}

		
		$date->modify('+1 month');

		$dateForward = Carbon::parse($end)->monthsUntil($dateOn);


		foreach ($dateForward as $key => $date2) {
			
			$summ = DB::table('summaries')
						->where(['summaries.report_date'=>$date2->format('n-Y'),'summaries.stock_number'=>$stock])
						->orderBy('summaries.created_at','asc')
						->get();
						

		}

		if(!empty($summ)){

		$appendix = array(
	    'font'  	=> array(
	        'bold'  => true,
	        'italic'=> true,
	        'color' => array('rgb' => '3b5998'),
	        'size'  => 16,
	        'name'  => 'Times New Roman'
	    ));

        $headerfont = array(
	    'font'  	=> array(
	        'bold'  => true,
	        'color' => array('rgb' => '000000'),
	        'size'  => 12,
	        'name'  => 'Times New Roman'
	    ));


	    $unitfont = array(
	    'font'  	=> array(
	        'bold'  => true,
	        'color' => array('rgb' => 'ffffff'),
	        'size'  => 12,
	        'name'  => 'Times New Roman'
	    ));

	    $borderMedium = array(
		    'borders' => array(
		        'outline' => array(
		            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM,
		            'color' => array('argb' => '000000'),
		        ),
		    ),
		);

		$borderAllMedium = array(
		    'borders' => array(
		        'allBorders' => array(
		            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM,
		            'color' => array('argb' => '000000'),
		        ),
		    ),
		);

		$borderThin = array(
		    'borders' => array(
		        'outline' => array(
		            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
		            'color' => array('argb' => '000000'),
		        ),
		    ),
		);

		$allCell = array(
		      'borders' => array(
		          'allBorders' => array(
		              'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
		              'color' => array('argb' => '000000'),
		          )
		      )
		  );

		$borderHair = array(
		    'borders' => array(
		        'outline' => array(
		            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_HAIR,
		            'color' => array('argb' => '000000'),
		        ),
		    ),
		);

		$riscolor = array(
	    'font'  	=> array(
	        'color' => array('rgb' => 'ff0000'),
	        'size'  => 11
	    ));

	    	$spreadsheet = new Spreadsheet();
			$sheet = $spreadsheet->getActiveSheet();
			$sheet = $spreadsheet->setActiveSheetIndex(0);
			$sheet = $spreadsheet->getActiveSheet()->setTitle('Property-Finance');

			$sheet->getColumnDimension('A')->setAutoSize(false);
			$sheet->getColumnDimension('A')->setWidth(11.89);
			$sheet->getColumnDimension('B')->setAutoSize(false);
			$sheet->getColumnDimension('B')->setWidth(15.56);
			$sheet->getColumnDimension('C')->setAutoSize(false);
			$sheet->getColumnDimension('C')->setWidth(12.67);
			$sheet->getColumnDimension('D')->setAutoSize(false);
			$sheet->getColumnDimension('D')->setWidth(12.67);
			$sheet->getColumnDimension('E')->setAutoSize(false);
			$sheet->getColumnDimension('E')->setWidth(12.67);
			$sheet->getColumnDimension('F')->setAutoSize(false);
			$sheet->getColumnDimension('F')->setWidth(12.67);
			$sheet->getColumnDimension('G')->setAutoSize(false);
			$sheet->getColumnDimension('G')->setWidth(12.67);
			$sheet->getColumnDimension('H')->setAutoSize(false);
			$sheet->getColumnDimension('H')->setWidth(12.67);
			$sheet->getColumnDimension('I')->setAutoSize(false);
			$sheet->getColumnDimension('I')->setWidth(12.67);
			$sheet->getColumnDimension('J')->setAutoSize(false);
			$sheet->getColumnDimension('J')->setWidth(12.67);
			$sheet->getColumnDimension('K')->setAutoSize(false);
			$sheet->getColumnDimension('K')->setWidth(15.56);
			$sheet->getColumnDimension('L')->setAutoSize(false);
			$sheet->getColumnDimension('L')->setWidth(13.67);

			$sheet->setCellValue('J2', 'Appendix 58');
			$sheet->setCellValue('A5', 'PROPERTY CARD');
			$sheet->mergeCells('A5:L5');
			$sheet->getStyle('A5:L5')->getAlignment()->setHorizontal('center');
			$sheet->getStyle('A5:L5')->getAlignment()->setVertical('center');

			$sheet->setCellValue('A7', 'Entity Name: '. $summ[0]->entity_name);
			$sheet->setCellValue('J7', 'Cluster:');
			$sheet->setCellValue('L7', $summ[0]->cluster);
			$sheet->setCellValue('A8', 'Item Name:');
			$sheet->setCellValue('C8', $summ[0]->description);
			$sheet->setCellValue('J8', 'Stock No.:');
			$sheet->setCellValue('L8', $summ[0]->stock_number);
			$sheet->setCellValue('A9', 'Description:');
			$sheet->setCellValue('C9', $summ[0]->description);
			$sheet->setCellValue('J9', 'Re-Order Point:');
			$sheet->setCellValue('L9', $summ[0]->re_order);
			$sheet->setCellValue('A10', 'Unit of Measurement:');
			$sheet->setCellValue('C10', $summ[0]->unit);

			$sheet->setCellValue('A11', 'Date');
			$sheet->mergeCells('A11:A12');
			$sheet->setCellValue('B11', 'Reference');
			$sheet->mergeCells('B11:B12');
			$sheet->setCellValue('C11','Receipt');
			$sheet->mergeCells('C11:E11');
			$sheet->setCellValue('C12','Qty');
			$sheet->setCellValue('D12','Price/Unit');
			$sheet->setCellValue('E12','Total');
			$sheet->setCellValue('F11','Issue');
			$sheet->mergeCells('F11:I11');
			$sheet->setCellValue('F12','Qty');
			$sheet->setCellValue('G12','Price/Unit');
			$sheet->setCellValue('H12','Total');
			$sheet->setCellValue('I12','Office');
			$sheet->setCellValue('J11','Balance');
			$sheet->setCellValue('J12','Qty');
			$sheet->setCellValue('K12','Ave. Price/Unit');
			$sheet->setCellValue('L12','Total Amount');
			$sheet->mergeCells('J11:L11');

			$sheet->getRowDimension(8)->setRowHeight(20);
			$sheet->getRowDimension(9)->setRowHeight(20);
			$sheet->getRowDimension(10)->setRowHeight(20);
			$sheet->getStyle('A11:L12')->getAlignment()->setHorizontal('center');
			$sheet->getStyle('A1:L12')->getAlignment()->setVertical('center');

			
			$sheet->setCellValue('A'.$row, Carbon::parse($pdate)->format('n/j/Y'));
			$sheet->setCellValue('B'.$row,'Physical Count');
			$sheet->getRowDimension($row)->setRowHeight(30);
			$sheet->setCellValue('C'.$row, number_format($pcount, 0, '.', ','));

			$sheet->getStyle('E'.$row)->getNumberFormat()->setFormatCode('###,###,##0.00');
			$sheet->getCell('E'.$row)
			    ->setValueExplicit(
			        $summ[0]->cost,
			        \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_NUMERIC
			    );

			$sheet->setCellValue('J'.$row, number_format($pcount, 0, '.', ','));

			$sheet->getStyle('L'.$row)->getNumberFormat()->setFormatCode('###,###,##0.00');
			$sheet->getCell('L'.$row)
			    ->setValueExplicit(
			        $summ[0]->cost,
			        \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_NUMERIC
			    );

			$averagecost = $summ[0]->cost / $pcount;
			$updatecost = $summ[0]->cost / $pcount;
			$runcost = $summ[0]->cost;

			$sheet->getStyle('K'.$row)->getNumberFormat()->setFormatCode('###,###,##0.00');
			$sheet->getCell('K'.$row)
			    ->setValueExplicit(
			        $averagecost,
			        \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_NUMERIC
			    );

			$sheet->getStyle('D'.$row)->getNumberFormat()->setFormatCode('###,###,##0.00');
			$sheet->getCell('D'.$row)
			    ->setValueExplicit(
			        $averagecost,
			        \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_NUMERIC
			    );

			$balanceqty = (int)$balanceqty+(int)$pcount;
			$receiptqty=(int)$receiptqty+(int)$pcount;
			$u_cost = $summ[0]->cost;
			$row+=1;
			foreach ($summ as $i)
			{
				

				if($i->type=='iar')
				{
					$sheet->setCellValue('A'.$row, Carbon::parse($i->invoice_date)->format('n/j/Y'));
					$sheet->setCellValue('B'.$row, 'IAR'.$i->ris_num);
					$sheet->setCellValue('C'.$row, number_format($i->quantity, 0, '.', ','));
					//$sheet->setCellValue('D'.$row, number_format($i->cost, 0, '.', ','));

						$pb = $i->quantity + $pb;
						$pbt = (int)$pbt + (int)$i->quantity;
						$u_cost = $u_cost + $i->cost;

					$newqty = (int)$pcount + (int)$i->quantity;

					$sheet->setCellValue('J'.$row, $newqty);

					$pcount = $newqty;

					$iarprice = $i->cost / $i->quantity;

					$sheet->getStyle('D'.$row)->getNumberFormat()->setFormatCode('###,###,##0.00');
					$sheet->getCell('D'.$row)
					    ->setValueExplicit(
					        $iarprice,
					        \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_NUMERIC
					    );

					$sheet->setCellValue('E'.$row, number_format($i->cost, 0, '.', ','));

					$sheet->getStyle('L'.$row)->getNumberFormat()->setFormatCode('###,###,##0.00');
					$sheet->getCell('L'.$row)
					    ->setValueExplicit(
					        (int)$i->cost + (int)$updateruncost,
					        \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_NUMERIC
					    );
	
					$a = (int)$i->cost + (int)$updateruncost;
					$b = (int)$newqty;
					$c = (int)$a/$b;
					$updatecost=$c;

					$sheet->getStyle('K'.$row)->getNumberFormat()->setFormatCode('###,###,##0.00');
					$sheet->getCell('K'.$row)
					    ->setValueExplicit(
					        $c,
					        \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_NUMERIC
					    );

					//$sheet->setCellValue('M'.$row,$updateruncost);
					$balanceqty = (int)$balanceqty+(int)$newqty;

					$pcount = $updatecost;
					$updateruncost = (int)$i->cost + (int)$updateruncost;

					$receiptqty=(int)$receiptqty+(int)$i->quantity;
				}else{
					$sheet->setCellValue('A'.$row, Carbon::parse($i->invoice_date)->format('n/j/Y'));
					$sheet->setCellValue('B'.$row, 'RIS'.$i->ris_num);
					$sheet->setCellValue('F'.$row, number_format($i->quantity, 0, '.', ','));
					//$sheet->setCellValue('H'.$row, number_format($i->cost, 0, '.', ','));

					$issueqty = (int)$issueqty+(int)$i->quantity;
					if($counter==1)
					{
						$issuetotal = (int)$i->quantity * (int)$updatecost;
						$totalcost = $i->cost - $issuetotal;

						$sheet->getStyle('G'.$row)->getNumberFormat()->setFormatCode('###,###,##0.00');
						$sheet->getCell('G'.$row)
					    ->setValueExplicit(
					        $updatecost,
					        \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_NUMERIC
					    );

						$sheet->getStyle('H'.$row)->getNumberFormat()->setFormatCode('###,###,##0.00');
						$sheet->getCell('H'.$row)
					    ->setValueExplicit(
					        $issuetotal,
					        \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_NUMERIC
					    );

					    $sheet->getStyle('L'.$row)->getNumberFormat()->setFormatCode('###,###,##0.00');
						$sheet->getCell('L'.$row)
						    ->setValueExplicit(
						        $totalcost,
						        \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_NUMERIC
						    );

						$newqty = (int)$pcount - (int)$i->quantity;

						$calc = (int)$i->cost - (int)$issuetotal;

						$sheet->getStyle('K'.$row)->getNumberFormat()->setFormatCode('###,###,##0.00');
						$sheet->getCell('K'.$row)
						    ->setValueExplicit(
						        (int)$calc/(int)$newqty,
						        \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_NUMERIC
						    );

						$updatecost = $calc/(int)$newqty;

						    //$sheet->setCellValue('M'.$row,$updatecost);
					}else{
						$issuetotal=$updateruncost-$updatecost;
						$totalcost = $issuetotal;

						$worksheet = $spreadsheet->getActiveSheet(); 

						$gtval = $worksheet->getCellByColumnAndRow(11, $row-1)->getValue();

						$sheet->getStyle('G'.$row)->getNumberFormat()->setFormatCode('###,###,##0.00');
						$sheet->getCell('G'.$row)
						    ->setValueExplicit(
						        $gtval,
						        \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_NUMERIC
						    );

						$sheet->getStyle('H'.$row)->getNumberFormat()->setFormatCode('###,###,##0.00');
						$sheet->getCell('H'.$row)
					    ->setValueExplicit(
					        $gtval * $i->quantity,
					        \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_NUMERIC
					    );

					    $gttotalval = $worksheet->getCellByColumnAndRow(12, $row-1)->getValue();

					    $sheet->getStyle('L'.$row)->getNumberFormat()->setFormatCode('###,###,##0.00');
						$sheet->getCell('L'.$row)
						    ->setValueExplicit(
						        $gttotalval- ($gtval * $i->quantity),
						        \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_NUMERIC
						    );

						$newqty = (int)$pcount - (int)$i->quantity;
						
						$calc = $updateruncost-($updatecost*$i->quantity);

						$sheet->getStyle('K'.$row)->getNumberFormat()->setFormatCode('###,###,##0.00');
						$sheet->getCell('K'.$row)
						    ->setValueExplicit(
						        (int)($gttotalval- ($gtval * $i->quantity))/(int)$newqty,
						        \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_NUMERIC
						    );

						

						$updatecost = $calc/(int)$newqty;
						

						    //$sheet->setCellValue('M'.$row,'->'.$updatecost);
					}

					
					$sheet->setCellValue('I'.$row, $i->division);

					$sheet->setCellValue('J'.$row, $newqty);

					$balanceqty = (int)$balanceqty+(int)$newqty;
					$pcount = $newqty;

					$updatecost = (int)$i->cost / (int)$i->quantity;
					$updateruncost=(int)$i->cost - (int)$issuetotal;

					$pb = $pb - $i->quantity;
					$iss = $iss + $i->quantity;

					//$sheet->getStyle('G'.$row)->applyFromArray($riscolor);
				}
				
				$sheet->getRowDimension($row)->setRowHeight(30);
				$row++;
				$counter++;
			}

			$sheet->getStyle('A11:K12')->getAlignment()->setHorizontal('center');
			$sheet->getStyle('A11:K12')->getAlignment()->setVertical('center');
			$sheet->getStyle('A5:L7')->applyFromArray($headerfont);
			$sheet->getStyle('A5:L5')->getAlignment()->setHorizontal('center');
			$sheet->getStyle('A11:L12')->applyFromArray($unitfont);
			$sheet->getStyle('A11:L12')->applyFromArray($borderAllMedium);
			$sheet->getStyle('A11:L12')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('3b5998');
			$sheet->getStyle('C8:C10')->applyFromArray($headerfont);
			$sheet->getStyle('A13:L'.$row)->applyFromArray($allCell);
			$sheet->getStyle('J2')->applyFromArray($appendix);

			$sheet->getStyle('H2')->applyFromArray($appendix);
			$sheet->getStyle('A8:L8')->applyFromArray($borderThin);
			$sheet->getStyle('A8:L9')->applyFromArray($borderThin);
			$sheet->getStyle('A8:L10')->applyFromArray($borderThin);
			$sheet->setCellValue('A'.$row,'TOTAL');
			$sheet->getStyle('A'.$row.':L'.$row)->applyFromArray($headerfont);
			$sheet->getStyle('A'.$row.':L'.$row)->applyFromArray($borderAllMedium);

			$sheet->getStyle('A13:L'.$row)->getAlignment()->setVertical('center');
			$sheet->setCellValue('J'.$row,$balanceqty);
			$sheet->setCellValue('F'.$row,$issueqty);
			$sheet->setCellValue('C'.$row,$receiptqty);

			$protect = Str::random(10);

			$sheet->getProtection()->setSheet(true);
			$sheet->getProtection()->setSort(true);
			$sheet->getProtection()->setInsertRows(true);
			$sheet->getProtection()->setFormatCells(true);

			$sheet->getProtection()->setPassword($protect);

			$writer = new Xlsx($spreadsheet);
			$writer->save('Property Card Finance.xlsx');

			$filename="Property Card Finance.xlsx";
			$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader("Xlsx");
			$spreadsheet = $reader->load("$filename");

			$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Mpdf');

			$pdf_path = 'Property Card Finance.pdf';
			$writer->save($pdf_path);

			//return redirect('/'.$pdf_path);
			return redirect('/'.$filename);

		}else{
			return view('stockcard.error-404');
		}
    }

    public function rcppe($year,$person,$dr)
    {
    	$data = DB::table('summaries')
    			->where(['summaries.report_date'=>$year,'summaries.requested_by'=>$person,'summaries.type'=>'ris'])
    			->orderBy('summaries.id','asc')
    			->get();

    	$req = DB::table('requests')
    			->where(['requests.requested_by'=>$person,'requests.date_receive'=>$dr])
    			->get();

    	$sig = DB::table('sign_settings')
    			->get();


    	$appendix = array(
	    	'font' 	=> array(
	        'bold'  => true,
	        'italic'=> true,
	        'color' => array('rgb' => '3b5998'),
	        'size'  => 16,
	        'name'  => 'Times New Roman'
	    ));

        $headerfont = array(
	    	'font' 	=> array(
	        'bold'  => true,
	        'color' => array('rgb' => '000000'),
	        'size'  => 12,
	        'name'  => 'Times New Roman'
	    ));

	    $entityfont = array(
	    	'font' 	=> array(
	        'color' => array('rgb' => '000000'),
	        'size'  => 12,
	        'name'  => 'Times New Roman'
	    ));

	   	$titlefont = array(
	    	'font' 	=> array(
	        'bold'  => true,
	        'color' => array('rgb' => '000000'),
	        'size'  => 14,
	        'name'  => 'Times New Roman'
	    ));

	    $subtitlefont = array(
	    	'font' 	=> array(
	        'bold'  => true,
	        'color' => array('rgb' => '000000'),
	        'size'  => 12,
	        'name'  => 'Times New Roman'
	    ));

	    $normalfont = array(
	    	'font' 	=> array(
	        'color' => array('rgb' => '000000'),
	        'size'  => 12,
	        'name'  => 'Times New Roman'
	    ));

	    $normalfont11 = array(
	    	'font' 	=> array(
	    	'bold'	=> 'true',
	        'color' => array('rgb' => '000000'),
	        'size'  => 10,
	        'name'  => 'Times New Roman'
	    ));


	    $unitfont = array(
	    	'font'  => array(
	    	'bold'	=> 'true',
	        'color' => array('rgb' => 'ffffff'),
	        'size'  => 9,
	        'name'  => 'Times New Roman'
	    ));

	    $detailfont = array(
	    	'font' 	=> array(
	        'color' => array('rgb' => '000000'),
	        'size'  => 10,
	        'name'  => 'Times New Roman'
	    ));


	    $borderMedium = array(
		    'borders' => array(
		        'outline' => array(
		            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM,
		            'color' => array('argb' => '000000'),
		        ),
		    ),
		);

		$borderAllMedium = array(
		    'borders' => array(
		        'allBorders' => array(
		            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM,
		            'color' => array('argb' => '000000'),
		        ),
		    ),
		);

		$borderThin = array(
		    'borders' => array(
		        'outline' => array(
		            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
		            'color' => array('argb' => '000000'),
		        ),
		    ),
		);

		$allCell = array(
		      'borders' => array(
		          'allBorders' => array(
		              'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
		              'color' => array('argb' => '000000'),
		          )
		      )
		  );

		$allCellWhite = array(
		      'borders' => array(
		          'allBorders' => array(
		              'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
		              'color' => array('argb' => 'ffffff'),
		          )
		      )
		  );

		$allCellMedium = array(
		      'borders' => array(
		          'allBorders' => array(
		              'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM,
		              'color' => array('argb' => '000000'),
		          )
		      )
		  );

		$borderBottomThin = array(
		    'borders' => array(
		        'bottom' => array(
		            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
		            'color' => array('argb' => '000000'),
		        ),
		    ),
		);

		if(!empty($data)) {
	        $spreadsheet = new Spreadsheet();
			$sheet = $spreadsheet->getActiveSheet();
			$sheet = $spreadsheet->getActiveSheet()->setTitle('RPCPPE');

			$sheet->getColumnDimension('A')->setAutoSize(false);
			$sheet->getColumnDimension('A')->setWidth(10.33);
			$sheet->getColumnDimension('B')->setAutoSize(false);
			$sheet->getColumnDimension('B')->setWidth(27.33);
			$sheet->getColumnDimension('C')->setAutoSize(false);
			$sheet->getColumnDimension('C')->setWidth(11.78);
			$sheet->getColumnDimension('D')->setAutoSize(false);
			$sheet->getColumnDimension('D')->setWidth(8.67);
			$sheet->getColumnDimension('E')->setAutoSize(false);
			$sheet->getColumnDimension('E')->setWidth(15.67);
			$sheet->getColumnDimension('F')->setAutoSize(false);
			$sheet->getColumnDimension('F')->setWidth(16.78);
			$sheet->getColumnDimension('G')->setAutoSize(false);
			$sheet->getColumnDimension('G')->setWidth(15.89);
			$sheet->getColumnDimension('H')->setAutoSize(false);
			$sheet->getColumnDimension('H')->setWidth(9.56);
			$sheet->getColumnDimension('I')->setAutoSize(false);
			$sheet->getColumnDimension('I')->setWidth(9.22);
			$sheet->getColumnDimension('J')->setAutoSize(false);
			$sheet->getColumnDimension('J')->setWidth(35.67);

			$sheet->setCellValue('J1', 'Appendix 73');
			$sheet->setCellValue('A3', 'REPORT ON THE PHYSICAL COUNT OF PROPERTY, PLANT AND EQUIPMENT');
			$sheet->setCellValue('A4', 'Office Equipment');
			$sheet->setCellValue('A5', '(Type of Property, Plant and Equipment)');
			$sheet->setCellValue('A6', 'As at '.date('F Y'));

			$sheet->setCellValue('A8', 'Fund Cluster: '.$data[0]->cluster);
			$sheet->setCellValue('A9', 'For which '.$data[0]->requested_by.',     '.$data[0]->requested_by_pos.',           ('.$data[0]->entity_name.')      is accountable, having assumed such accountability on    ('.date('F j, Y', strtotime($data[0]->date_receive)).').'); 

			$sheet->setCellValue('A11','ARTICLE');
			$sheet->setCellValue('B11','DESCRIPTION');
			$sheet->setCellValue('C11','PROPERTY NUMBER');
			$sheet->setCellValue('D11','UNIT OF MEASURE');
			$sheet->setCellValue('E11','UNIT VALUE');
			$sheet->setCellValue('F11','QUANTITY'.PHP_EOL.'per'.PHP_EOL.'PROPERTY CARD');
			$sheet->setCellValue('G11','QUANTITY'.PHP_EOL.'per'.PHP_EOL.'PHYSICAL COUNT');
			$sheet->setCellValue('H11','SHORTAGE/OVERAGE');
			$sheet->setCellValue('J11','REMAKS');
			$sheet->setCellValue('H13','Quantity');
			$sheet->setCellValue('I13','Value');
			$sheet->mergeCells('H11:I12');
			$sheet->mergeCells('A11:A13');
			$sheet->mergeCells('B11:B13');
			$sheet->mergeCells('C11:C13');
			$sheet->mergeCells('D11:D13');
			$sheet->mergeCells('E11:E13');
			$sheet->mergeCells('F11:F13');
			$sheet->mergeCells('G11:G13');
			$sheet->mergeCells('J11:J13');

			$row=13;

			foreach($data as $i)
			{
				$row++;
				//$sheet->setCellValue('A'.$row,$i->article);
				$sheet->setCellValue('B'.$row,$i->description);
				$sheet->setCellValue('C'.$row,$i->prop_num);
				$sheet->setCellValue('D'.$row,$i->quantity.' '.$i->unit);
				$sheet->setCellValue('E'.$row,number_format($i->cost, 2, '.', ','));
				$sheet->getStyle('E'.$row)->getAlignment()->setHorizontal('right');
				//$sheet->setCellValue('F'.$row,$i->property_qty);
				//$sheet->setCellValue('G'.$row,$i->physical_qty);
				//$sheet->setCellValue('H'.$row,$i->short_qty);
				//$sheet->setCellValue('I'.$row,$i->short_value);
				$sheet->setCellValue('J'.$row,$i->remarks);
				$sheet->getStyle('G'.$row.':I'.$row)->getAlignment()->setHorizontal('center');
			}

			$sheet->getStyle('A11:J'.$row)->applyFromArray($allCell);
			$sheet->getStyle('A11:A'.$row)->applyFromArray($borderMedium);
			$sheet->getStyle('B11:B'.$row)->applyFromArray($borderMedium);
			$sheet->getStyle('C11:C'.$row)->applyFromArray($borderMedium);
			$sheet->getStyle('D11:D'.$row)->applyFromArray($borderMedium);
			$sheet->getStyle('E11:E'.$row)->applyFromArray($borderMedium);
			$sheet->getStyle('F11:F'.$row)->applyFromArray($borderMedium);
			$sheet->getStyle('G11:G'.$row)->applyFromArray($borderMedium);
			$sheet->getStyle('H11:H'.$row)->applyFromArray($borderMedium);
			$sheet->getStyle('I11:I'.$row)->applyFromArray($borderMedium);
			$sheet->getStyle('J11:J'.$row)->applyFromArray($borderMedium);
			$sheet->getStyle('H11:I13')->applyFromArray($borderAllMedium);
			$sheet->getStyle('A14:J'.$row)->getAlignment()->setWrapText(true);

			$row=(int)$row+2;
			$sheet->setCellValue('A'.$row,'Certified Correct by:');
			$sheet->setCellValue('D'.$row,'Approved by:');
			$sheet->setCellValue('H'.$row,'Verified by:');

			$row=(int)$row+3;
			if(count($req)>0){
				$sheet->setCellValue('B'.$row,strtoupper($req[0]->issued_by));
				$sheet->setCellValue('D'.$row,strtoupper($req[0]->approve_by));
			}
			//$sheet->setCellValue('I'.$row,strtoupper($person[0]->verifiedby));
			$sheet->mergeCells('D'.$row.':G'.$row);
			$sheet->mergeCells('I'.$row.':J'.$row);
			$sheet->getStyle('B'.$row)->getAlignment()->setHorizontal('center');
			$sheet->getStyle('D'.$row.':G'.$row)->getAlignment()->setHorizontal('center');
			$sheet->getStyle('I'.$row.':J'.$row)->getAlignment()->setHorizontal('center');

			$sheet->getStyle('B'.$row)->applyFromArray($borderBottomThin);
			$sheet->getStyle('D'.$row.':G'.$row)->applyFromArray($borderBottomThin);
			$sheet->getStyle('I'.$row.':J'.$row)->applyFromArray($borderBottomThin);
			$sheet->getStyle('B'.$row)->applyFromArray($headerfont);
			$sheet->getStyle('D'.$row.':G'.$row)->applyFromArray($headerfont);
			$sheet->getStyle('I'.$row.':J'.$row)->applyFromArray($headerfont);

			$sheet->setCellValue('B'.$row,$sig[0]->RPCIInvCommitteeChair);
			$sheet->setCellValue('D'.$row,$sig[0]->RPCIOICChair);
			$sheet->setCellValue('I'.$row,$sig[0]->RPCICOARep);

			$row=(int)$row+1;
			$sheet->setCellValue('B'.$row,'Signature over Printed Name of Inventory Committee Chair and Members');
			$sheet->setCellValue('E'.$row,'Signature over Printed Name of Head of  Agency/Entity or Authorized Representative');
			$sheet->setCellValue('I'.$row,'Signature over Printed Name of COA Representative');
			$sheet->getRowDimension($row)->setRowHeight(42);
			$sheet->mergeCells('E'.$row.':G'.$row);
			$sheet->mergeCells('I'.$row.':J'.$row);
			$sheet->getStyle('A'.$row.':J'.$row)->getAlignment()->setWrapText(true);
			$sheet->getStyle('A'.$row.':J'.$row)->getAlignment()->setHorizontal('center');

			$sheet->mergeCells('A3:J3');
			$sheet->mergeCells('A4:J4');
			$sheet->mergeCells('A5:J5');
			$sheet->mergeCells('A6:J6');
			$sheet->getStyle('A14:J'.$row)->applyFromArray($detailfont);
			$sheet->getStyle('A14:J'.$row)->getAlignment()->setVertical('center');
			$sheet->getStyle('J1')->applyFromArray($appendix);
			$sheet->getStyle('J1')->getAlignment()->setHorizontal('right');
			$sheet->getStyle('A3')->applyFromArray($titlefont);
			$sheet->getStyle('A3')->getAlignment()->setHorizontal('center');
			$sheet->getStyle('A3')->getAlignment()->setVertical('center');
			$sheet->getRowDimension(3)->setRowHeight(20);
			$sheet->getStyle('A4')->applyFromArray($subtitlefont);
			$sheet->getStyle('A4')->getAlignment()->setHorizontal('center');
			$sheet->getStyle('A4')->getAlignment()->setVertical('center');
			$sheet->getStyle('A5:A6')->applyFromArray($normalfont);
			$sheet->getStyle('A5:A6')->getAlignment()->setHorizontal('center');
			$sheet->getStyle('A5:A6')->getAlignment()->setVertical('center');
			$sheet->getStyle('A8:A9')->applyFromArray($normalfont11);
			$sheet->getStyle('A11:J13')->applyFromArray($unitfont);
			$sheet->getStyle('A11:J13')->getAlignment()->setHorizontal('center');
			$sheet->getStyle('A11:J13')->getAlignment()->setVertical('center');
			$sheet->getStyle('A11:J13')->getAlignment()->setWrapText(true);
			$sheet->getStyle('A11:J13')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('3b5998');
			$sheet->getRowDimension($row)->setRowHeight(42);

			$protect = Str::random(10);

			$sheet->getProtection()->setSheet(true);
			$sheet->getProtection()->setSort(true);
			$sheet->getProtection()->setInsertRows(true);
			$sheet->getProtection()->setFormatCells(true);

			$sheet->getProtection()->setPassword($protect);

			$writer = new Xlsx($spreadsheet);
			$writer->save('RCPPE.xlsx');

			$filename="RCPPE.xlsx";
			$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader("Xlsx");
			$spreadsheet = $reader->load("$filename");

			$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Mpdf');

			$pdf_path = 'RCPPE.pdf';
			$writer->save($pdf_path);

			//return redirect('/'.$pdf_path);
			return redirect('/'.$filename);
		}else{
			return view('error-404');
		}
    }

    public function ics()
    {
    	
    	$data = DB::table('summaries')
    			->where(['summaries.type'=>'ris','summaries.category'=>'StockCard'])
    			->orderBy('summaries.created_at','desc')
    			->get();

    	$headerfont = array(
	    	'font' 	=> array(
	        'bold'  => true,
	        'color' => array('rgb' => '000000'),
	        'size'  => 15,
	        'name'  => 'Calibri'
	    ));

	    $unitfont = array(
	    	'font'  => array(
	    	'bold'	=> 'true',
	        'color' => array('rgb' => 'ffffff'),
	        'size'  => 11,
	        'name'  => 'Calibri'
	    ));



		$allCell = array(
		      'borders' => array(
		          'allBorders' => array(
		              'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
		              'color' => array('argb' => '000000'),
		          )
		      )
		  );

    	$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();
		$sheet = $spreadsheet->getActiveSheet()->setTitle('ICS');

		$sheet->getColumnDimension('A')->setAutoSize(false);
		$sheet->getColumnDimension('A')->setWidth(15.56);
		$sheet->getColumnDimension('B')->setAutoSize(false);
		$sheet->getColumnDimension('B')->setWidth(6.22);
		$sheet->getColumnDimension('C')->setAutoSize(false);
		$sheet->getColumnDimension('C')->setWidth(8.33);
		$sheet->getColumnDimension('D')->setAutoSize(false);
		$sheet->getColumnDimension('D')->setWidth(11.00);
		$sheet->getColumnDimension('E')->setAutoSize(false);
		$sheet->getColumnDimension('E')->setWidth(11.33);
		$sheet->getColumnDimension('F')->setAutoSize(false);
		$sheet->getColumnDimension('F')->setWidth(33.78);
		$sheet->getColumnDimension('G')->setAutoSize(false);
		$sheet->getColumnDimension('G')->setWidth(20.22);
		$sheet->getColumnDimension('H')->setAutoSize(false);
		$sheet->getColumnDimension('H')->setWidth(11.00);
		$sheet->getColumnDimension('I')->setAutoSize(false);
		$sheet->getColumnDimension('I')->setWidth(11.00);
		$sheet->getColumnDimension('J')->setAutoSize(false);
		$sheet->getColumnDimension('J')->setWidth(27.89);



		$sheet->setCellValue('A1','INVENTORY CUSTODIAN SLIP');
		//$sheet->setCellValue('A2','END-USER: '. strtoupper($id));
		$sheet->setCellValue('A2','ALL RECORD(S)');
		$sheet->setCellValue('A4','ICS No.');
		$sheet->setCellValue('B4','Qty');
		$sheet->setCellValue('C4','UNIT');
		$sheet->setCellValue('D4','Amount');
		$sheet->setCellValue('D5','Unit Cost');
		$sheet->setCellValue('E5','Total Cost');
		$sheet->setCellValue('F4','Description');
		$sheet->setCellValue('G4','Property Number/ Inventory Item No.');
		$sheet->setCellValue('H4','Estimated Useful Life');
		$sheet->setCellValue('I4','End-User');
		$sheet->setCellValue('J4','Remarks');
		$sheet->mergeCells('A4:A5');$sheet->mergeCells('B4:B5');$sheet->mergeCells('C4:C5');$sheet->mergeCells('D4:E4');
		$sheet->mergeCells('F4:F5');$sheet->mergeCells('G4:G5');$sheet->mergeCells('H4:H5');$sheet->mergeCells('I4:I5');
		$sheet->mergeCells('J4:J5');
		$sheet->getStyle('A4:J5')->getAlignment()->setWrapText(true);
		$sheet->getStyle('A4:J5')->getAlignment()->setHorizontal('center');
		$sheet->getStyle('A4:J5')->getAlignment()->setVertical('center');
		$sheet->getStyle('A1:A2')->applyFromArray($headerfont);
		$sheet->getStyle('A4:J5')->applyFromArray($unitfont);
		$sheet->getStyle('A4:J5')->applyFromArray($allCell);
		$sheet->getStyle('A4:J5')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('3b5998');

		$row=5;
		
		foreach($data as $i)
		{
			$row++;
			$sheet->setCellValue('A'.$row,$i->par_ics_series);
			$sheet->setCellValue('B'.$row,$i->quantity);
			$sheet->setCellValue('C'.$row,$i->unit);
			$sheet->setCellValue('D'.$row,number_format($i->cost, 2, '.', ','));
			$sheet->setCellValue('E'.$row,number_format($i->cost * $i->quantity, 2, '.', ','));
			$sheet->setCellValue('F'.$row,$i->description);
			$sheet->setCellValue('G'.$row,$i->prop_num);
			$sheet->setCellValue('H'.$row,$i->consume_days);
			$sheet->setCellValue('I'.$row,$i->requested_by);
			$sheet->setCellValue('J'.$row,$i->remarks);
			$sheet->getRowDimension($row)->setRowHeight(-1);
			$sheet->getStyle('A'.$row.':J'.$row)->applyFromArray($allCell);
			$sheet->getStyle('A'.$row.':J'.$row)->getAlignment()->setWrapText(true);
			$sheet->getStyle('A'.$row.':J'.$row)->getAlignment()->setVertical('center');
			$sheet->getStyle('D'.$row.':E'.$row)->getAlignment()->setHorizontal('right');
		}
		

		$protect = Str::random(10);

		$sheet->getProtection()->setSheet(true);
		$sheet->getProtection()->setSort(true);
		$sheet->getProtection()->setInsertRows(true);
		$sheet->getProtection()->setFormatCells(true);

		$sheet->getProtection()->setPassword($protect);

		$writer = new Xlsx($spreadsheet);
		$writer->save('Inventory Custodian Slip.xlsx');

		$filename="Inventory Custodian Slip.xlsx";
		$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader("Xlsx");
		$spreadsheet = $reader->load("$filename");

		$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Mpdf');

		$pdf_path = 'Inventory Custodian Slip.pdf';
		$writer->save($pdf_path);

		//return redirect('/'.$pdf_path);
		return redirect('/'.$filename);
		
    }

    public function ics_cy_user($id)
    {
    	
    	if (is_numeric($id)){

	    	$data = DB::table('summaries')
	    			->where(['summaries.type'=>'ris','summaries.category'=>'StockCard','summaries.cy'=>$id])
	    			->orderBy('summaries.created_at','desc')
	    			->get();

	    	$headerfont = array(
		    	'font' 	=> array(
		        'bold'  => true,
		        'color' => array('rgb' => '000000'),
		        'size'  => 15,
		        'name'  => 'Calibri'
		    ));

		    $unitfont = array(
		    	'font'  => array(
		    	'bold'	=> 'true',
		        'color' => array('rgb' => 'ffffff'),
		        'size'  => 11,
		        'name'  => 'Calibri'
		    ));



			$allCell = array(
			      'borders' => array(
			          'allBorders' => array(
			              'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
			              'color' => array('argb' => '000000'),
			          )
			      )
			  );

	    	$spreadsheet = new Spreadsheet();
			$sheet = $spreadsheet->getActiveSheet();
			$sheet = $spreadsheet->getActiveSheet()->setTitle('ICS');

			$sheet->getColumnDimension('A')->setAutoSize(false);
			$sheet->getColumnDimension('A')->setWidth(15.56);
			$sheet->getColumnDimension('B')->setAutoSize(false);
			$sheet->getColumnDimension('B')->setWidth(6.22);
			$sheet->getColumnDimension('C')->setAutoSize(false);
			$sheet->getColumnDimension('C')->setWidth(8.33);
			$sheet->getColumnDimension('D')->setAutoSize(false);
			$sheet->getColumnDimension('D')->setWidth(11.00);
			$sheet->getColumnDimension('E')->setAutoSize(false);
			$sheet->getColumnDimension('E')->setWidth(11.33);
			$sheet->getColumnDimension('F')->setAutoSize(false);
			$sheet->getColumnDimension('F')->setWidth(33.78);
			$sheet->getColumnDimension('G')->setAutoSize(false);
			$sheet->getColumnDimension('G')->setWidth(20.22);
			$sheet->getColumnDimension('H')->setAutoSize(false);
			$sheet->getColumnDimension('H')->setWidth(11.00);
			$sheet->getColumnDimension('I')->setAutoSize(false);
			$sheet->getColumnDimension('I')->setWidth(11.00);
			$sheet->getColumnDimension('J')->setAutoSize(false);
			$sheet->getColumnDimension('J')->setWidth(27.89);



			$sheet->setCellValue('A1','INVENTORY CUSTODIAN SLIP');
			$sheet->setCellValue('A2','CALENDAR YEAR: '. strtoupper($id));
			//$sheet->setCellValue('A2','ALL USER');
			$sheet->setCellValue('A4','ICS No.');
			$sheet->setCellValue('B4','Qty');
			$sheet->setCellValue('C4','UNIT');
			$sheet->setCellValue('D4','Amount');
			$sheet->setCellValue('D5','Unit Cost');
			$sheet->setCellValue('E5','Total Cost');
			$sheet->setCellValue('F4','Description');
			$sheet->setCellValue('G4','Property Number/ Inventory Item No.');
			$sheet->setCellValue('H4','Estimated Useful Life');
			$sheet->setCellValue('I4','End-User');
			$sheet->setCellValue('J4','Remarks');
			$sheet->mergeCells('A4:A5');$sheet->mergeCells('B4:B5');$sheet->mergeCells('C4:C5');$sheet->mergeCells('D4:E4');
			$sheet->mergeCells('F4:F5');$sheet->mergeCells('G4:G5');$sheet->mergeCells('H4:H5');$sheet->mergeCells('I4:I5');
			$sheet->mergeCells('J4:J5');
			$sheet->getStyle('A4:J5')->getAlignment()->setWrapText(true);
			$sheet->getStyle('A4:J5')->getAlignment()->setHorizontal('center');
			$sheet->getStyle('A4:J5')->getAlignment()->setVertical('center');
			$sheet->getStyle('A1:A2')->applyFromArray($headerfont);
			$sheet->getStyle('A4:J5')->applyFromArray($unitfont);
			$sheet->getStyle('A4:J5')->applyFromArray($allCell);
			$sheet->getStyle('A4:J5')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('3b5998');

			$row=5;
			
			foreach($data as $i)
			{
				$row++;
				$sheet->setCellValue('A'.$row,$i->par_ics_series);
				$sheet->setCellValue('B'.$row,$i->quantity);
				$sheet->setCellValue('C'.$row,$i->unit);
				$sheet->setCellValue('D'.$row,number_format($i->cost, 2, '.', ','));
				$sheet->setCellValue('E'.$row,number_format($i->cost * $i->quantity, 2, '.', ','));
				$sheet->setCellValue('F'.$row,$i->description);
				$sheet->setCellValue('G'.$row,$i->prop_num);
				$sheet->setCellValue('H'.$row,$i->consume_days);
				$sheet->setCellValue('I'.$row,$i->requested_by);
				$sheet->setCellValue('J'.$row,$i->remarks);
				$sheet->getRowDimension($row)->setRowHeight(-1);
				$sheet->getStyle('A'.$row.':J'.$row)->applyFromArray($allCell);
				$sheet->getStyle('A'.$row.':J'.$row)->getAlignment()->setWrapText(true);
				$sheet->getStyle('A'.$row.':J'.$row)->getAlignment()->setVertical('center');
				$sheet->getStyle('D'.$row.':E'.$row)->getAlignment()->setHorizontal('right');
			}
			

			$protect = Str::random(10);

			$sheet->getProtection()->setSheet(true);
			$sheet->getProtection()->setSort(true);
			$sheet->getProtection()->setInsertRows(true);
			$sheet->getProtection()->setFormatCells(true);

			$sheet->getProtection()->setPassword($protect);

			$writer = new Xlsx($spreadsheet);
			$writer->save('Inventory Custodian Slip.xlsx');

			$filename="Inventory Custodian Slip.xlsx";
			$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader("Xlsx");
			$spreadsheet = $reader->load("$filename");

			$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Mpdf');

			$pdf_path = 'Inventory Custodian Slip.pdf';
			$writer->save($pdf_path);

			//return redirect('/'.$pdf_path);
			return redirect('/'.$filename);
		}else{

		$data = DB::table('summaries')
	    			->where(['summaries.type'=>'ris','summaries.category'=>'StockCard','summaries.requested_by'=>$id])
	    			->orderBy('summaries.created_at','desc')
	    			->get();

	    	$headerfont = array(
		    	'font' 	=> array(
		        'bold'  => true,
		        'color' => array('rgb' => '000000'),
		        'size'  => 15,
		        'name'  => 'Calibri'
		    ));

		    $unitfont = array(
		    	'font'  => array(
		    	'bold'	=> 'true',
		        'color' => array('rgb' => 'ffffff'),
		        'size'  => 11,
		        'name'  => 'Calibri'
		    ));



			$allCell = array(
			      'borders' => array(
			          'allBorders' => array(
			              'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
			              'color' => array('argb' => '000000'),
			          )
			      )
			  );

	    	$spreadsheet = new Spreadsheet();
			$sheet = $spreadsheet->getActiveSheet();

			$sheet->getColumnDimension('A')->setAutoSize(false);
			$sheet->getColumnDimension('A')->setWidth(15.56);
			$sheet->getColumnDimension('B')->setAutoSize(false);
			$sheet->getColumnDimension('B')->setWidth(6.22);
			$sheet->getColumnDimension('C')->setAutoSize(false);
			$sheet->getColumnDimension('C')->setWidth(8.33);
			$sheet->getColumnDimension('D')->setAutoSize(false);
			$sheet->getColumnDimension('D')->setWidth(11.00);
			$sheet->getColumnDimension('E')->setAutoSize(false);
			$sheet->getColumnDimension('E')->setWidth(11.33);
			$sheet->getColumnDimension('F')->setAutoSize(false);
			$sheet->getColumnDimension('F')->setWidth(33.78);
			$sheet->getColumnDimension('G')->setAutoSize(false);
			$sheet->getColumnDimension('G')->setWidth(20.22);
			$sheet->getColumnDimension('H')->setAutoSize(false);
			$sheet->getColumnDimension('H')->setWidth(11.00);
			$sheet->getColumnDimension('I')->setAutoSize(false);
			$sheet->getColumnDimension('I')->setWidth(11.00);
			$sheet->getColumnDimension('J')->setAutoSize(false);
			$sheet->getColumnDimension('J')->setWidth(27.89);



			$sheet->setCellValue('A1','INVENTORY CUSTODIAN SLIP');
			$sheet->setCellValue('A2','END-USER: '. strtoupper($id));
			//$sheet->setCellValue('A2','ALL USER');
			$sheet->setCellValue('A4','ICS No.');
			$sheet->setCellValue('B4','Qty');
			$sheet->setCellValue('C4','UNIT');
			$sheet->setCellValue('D4','Amount');
			$sheet->setCellValue('D5','Unit Cost');
			$sheet->setCellValue('E5','Total Cost');
			$sheet->setCellValue('F4','Description');
			$sheet->setCellValue('G4','Property Number/ Inventory Item No.');
			$sheet->setCellValue('H4','Estimated Useful Life');
			$sheet->setCellValue('I4','End-User');
			$sheet->setCellValue('J4','Remarks');
			$sheet->mergeCells('A4:A5');$sheet->mergeCells('B4:B5');$sheet->mergeCells('C4:C5');$sheet->mergeCells('D4:E4');
			$sheet->mergeCells('F4:F5');$sheet->mergeCells('G4:G5');$sheet->mergeCells('H4:H5');$sheet->mergeCells('I4:I5');
			$sheet->mergeCells('J4:J5');
			$sheet->getStyle('A4:J5')->getAlignment()->setWrapText(true);
			$sheet->getStyle('A4:J5')->getAlignment()->setHorizontal('center');
			$sheet->getStyle('A4:J5')->getAlignment()->setVertical('center');
			$sheet->getStyle('A1:A2')->applyFromArray($headerfont);
			$sheet->getStyle('A4:J5')->applyFromArray($unitfont);
			$sheet->getStyle('A4:J5')->applyFromArray($allCell);
			$sheet->getStyle('A4:J5')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('3b5998');

			$row=5;
			
			foreach($data as $i)
			{
				$row++;
				$sheet->setCellValue('A'.$row,$i->par_ics_series);
				$sheet->setCellValue('B'.$row,$i->quantity);
				$sheet->setCellValue('C'.$row,$i->unit);
				$sheet->setCellValue('D'.$row,number_format($i->cost, 2, '.', ','));
				$sheet->setCellValue('E'.$row,number_format($i->cost * $i->quantity, 2, '.', ','));
				$sheet->setCellValue('F'.$row,$i->description);
				$sheet->setCellValue('G'.$row,$i->prop_num);
				$sheet->setCellValue('H'.$row,$i->consume_days);
				$sheet->setCellValue('I'.$row,$i->requested_by);
				$sheet->setCellValue('J'.$row,$i->remarks);
				$sheet->getRowDimension($row)->setRowHeight(-1);
				$sheet->getStyle('A'.$row.':J'.$row)->applyFromArray($allCell);
				$sheet->getStyle('A'.$row.':J'.$row)->getAlignment()->setWrapText(true);
				$sheet->getStyle('A'.$row.':J'.$row)->getAlignment()->setVertical('center');
				$sheet->getStyle('D'.$row.':E'.$row)->getAlignment()->setHorizontal('right');
			}
			

			$protect = Str::random(10);

			$sheet->getProtection()->setSheet(true);
			$sheet->getProtection()->setSort(true);
			$sheet->getProtection()->setInsertRows(true);
			$sheet->getProtection()->setFormatCells(true);

			$sheet->getProtection()->setPassword($protect);

			$writer = new Xlsx($spreadsheet);
			$writer->save('Inventory Custodian Slip.xlsx');

			$filename="Inventory Custodian Slip.xlsx";
			$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader("Xlsx");
			$spreadsheet = $reader->load("$filename");

			$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Mpdf');

			$pdf_path = 'Inventory Custodian Slip.pdf';
			$writer->save($pdf_path);

			//return redirect('/'.$pdf_path);
			return redirect('/'.$filename);
			
		}
	}

	public function ics_cy_user_export($user,$cy){
		$data = DB::table('summaries')
	    			->where(['summaries.type'=>'ris','summaries.category'=>'StockCard','summaries.cy'=>$cy,'summaries.requested_by'=>$user])
	    			->orderBy('summaries.created_at','desc')
	    			->get();

	    	$headerfont = array(
		    	'font' 	=> array(
		        'bold'  => true,
		        'color' => array('rgb' => '000000'),
		        'size'  => 15,
		        'name'  => 'Calibri'
		    ));

		    $unitfont = array(
		    	'font'  => array(
		    	'bold'	=> 'true',
		        'color' => array('rgb' => 'ffffff'),
		        'size'  => 11,
		        'name'  => 'Calibri'
		    ));



			$allCell = array(
			      'borders' => array(
			          'allBorders' => array(
			              'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
			              'color' => array('argb' => '000000'),
			          )
			      )
			  );

	    	$spreadsheet = new Spreadsheet();
			$sheet = $spreadsheet->getActiveSheet();
			$sheet = $spreadsheet->getActiveSheet()->setTitle('ICS');

			$sheet->getColumnDimension('A')->setAutoSize(false);
			$sheet->getColumnDimension('A')->setWidth(15.56);
			$sheet->getColumnDimension('B')->setAutoSize(false);
			$sheet->getColumnDimension('B')->setWidth(6.22);
			$sheet->getColumnDimension('C')->setAutoSize(false);
			$sheet->getColumnDimension('C')->setWidth(8.33);
			$sheet->getColumnDimension('D')->setAutoSize(false);
			$sheet->getColumnDimension('D')->setWidth(11.00);
			$sheet->getColumnDimension('E')->setAutoSize(false);
			$sheet->getColumnDimension('E')->setWidth(11.33);
			$sheet->getColumnDimension('F')->setAutoSize(false);
			$sheet->getColumnDimension('F')->setWidth(33.78);
			$sheet->getColumnDimension('G')->setAutoSize(false);
			$sheet->getColumnDimension('G')->setWidth(20.22);
			$sheet->getColumnDimension('H')->setAutoSize(false);
			$sheet->getColumnDimension('H')->setWidth(11.00);
			$sheet->getColumnDimension('I')->setAutoSize(false);
			$sheet->getColumnDimension('I')->setWidth(11.00);
			$sheet->getColumnDimension('J')->setAutoSize(false);
			$sheet->getColumnDimension('J')->setWidth(27.89);



			$sheet->setCellValue('A1','INVENTORY CUSTODIAN SLIP');
			$sheet->setCellValue('A2','CALENDAR YEAR: '. strtoupper($cy) . ' AND BY END-USER: '. strtoupper($user));
			//$sheet->setCellValue('A2','ALL USER');
			$sheet->setCellValue('A4','ICS No.');
			$sheet->setCellValue('B4','Qty');
			$sheet->setCellValue('C4','UNIT');
			$sheet->setCellValue('D4','Amount');
			$sheet->setCellValue('D5','Unit Cost');
			$sheet->setCellValue('E5','Total Cost');
			$sheet->setCellValue('F4','Description');
			$sheet->setCellValue('G4','Property Number/ Inventory Item No.');
			$sheet->setCellValue('H4','Estimated Useful Life');
			$sheet->setCellValue('I4','End-User');
			$sheet->setCellValue('J4','Remarks');
			$sheet->mergeCells('A4:A5');$sheet->mergeCells('B4:B5');$sheet->mergeCells('C4:C5');$sheet->mergeCells('D4:E4');
			$sheet->mergeCells('F4:F5');$sheet->mergeCells('G4:G5');$sheet->mergeCells('H4:H5');$sheet->mergeCells('I4:I5');
			$sheet->mergeCells('J4:J5');
			$sheet->getStyle('A4:J5')->getAlignment()->setWrapText(true);
			$sheet->getStyle('A4:J5')->getAlignment()->setHorizontal('center');
			$sheet->getStyle('A4:J5')->getAlignment()->setVertical('center');
			$sheet->getStyle('A1:A2')->applyFromArray($headerfont);
			$sheet->getStyle('A4:J5')->applyFromArray($unitfont);
			$sheet->getStyle('A4:J5')->applyFromArray($allCell);
			$sheet->getStyle('A4:J5')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('3b5998');

			$row=5;
			
			foreach($data as $i)
			{
				$row++;
				$sheet->setCellValue('A'.$row,$i->par_ics_series);
				$sheet->setCellValue('B'.$row,$i->quantity);
				$sheet->setCellValue('C'.$row,$i->unit);
				$sheet->setCellValue('D'.$row,number_format($i->cost, 2, '.', ','));
				$sheet->setCellValue('E'.$row,number_format($i->cost * $i->quantity, 2, '.', ','));
				$sheet->setCellValue('F'.$row,$i->description);
				$sheet->setCellValue('G'.$row,$i->prop_num);
				$sheet->setCellValue('H'.$row,$i->consume_days);
				$sheet->setCellValue('I'.$row,$i->requested_by);
				$sheet->setCellValue('J'.$row,$i->remarks);
				$sheet->getRowDimension($row)->setRowHeight(-1);
				$sheet->getStyle('A'.$row.':J'.$row)->applyFromArray($allCell);
				$sheet->getStyle('A'.$row.':J'.$row)->getAlignment()->setWrapText(true);
				$sheet->getStyle('A'.$row.':J'.$row)->getAlignment()->setVertical('center');
				$sheet->getStyle('D'.$row.':E'.$row)->getAlignment()->setHorizontal('right');
			}
			

			$protect = Str::random(10);

			$sheet->getProtection()->setSheet(true);
			$sheet->getProtection()->setSort(true);
			$sheet->getProtection()->setInsertRows(true);
			$sheet->getProtection()->setFormatCells(true);

			$sheet->getProtection()->setPassword($protect);

			$writer = new Xlsx($spreadsheet);
			$writer->save('Inventory Custodian Slip.xlsx');

			$filename="Inventory Custodian Slip.xlsx";
			$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader("Xlsx");
			$spreadsheet = $reader->load("$filename");

			$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Mpdf');

			$pdf_path = 'Inventory Custodian Slip.pdf';
			$writer->save($pdf_path);

			//return redirect('/'.$pdf_path);
			return redirect('/'.$filename);
	}

	//=====PAR===============

	public function par()
    {
    	
    	$data = DB::table('summaries')
    			->where(['summaries.type'=>'ris','summaries.category'=>'PropertyCard'])
    			->orderBy('summaries.created_at','desc')
    			->get();

    	$headerfont = array(
	    	'font' 	=> array(
	        'bold'  => true,
	        'color' => array('rgb' => '000000'),
	        'size'  => 15,
	        'name'  => 'Calibri'
	    ));

	    $unitfont = array(
	    	'font'  => array(
	    	'bold'	=> 'true',
	        'color' => array('rgb' => 'ffffff'),
	        'size'  => 11,
	        'name'  => 'Calibri'
	    ));



		$allCell = array(
		      'borders' => array(
		          'allBorders' => array(
		              'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
		              'color' => array('argb' => '000000'),
		          )
		      )
		  );

    	$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();
		$sheet = $spreadsheet->getActiveSheet()->setTitle('PAR');

		$sheet->getColumnDimension('A')->setAutoSize(false);
		$sheet->getColumnDimension('A')->setWidth(15.56);
		$sheet->getColumnDimension('B')->setAutoSize(false);
		$sheet->getColumnDimension('B')->setWidth(6.22);
		$sheet->getColumnDimension('C')->setAutoSize(false);
		$sheet->getColumnDimension('C')->setWidth(8.33);
		$sheet->getColumnDimension('D')->setAutoSize(false);
		$sheet->getColumnDimension('D')->setWidth(11.00);
		$sheet->getColumnDimension('E')->setAutoSize(false);
		$sheet->getColumnDimension('E')->setWidth(11.33);
		$sheet->getColumnDimension('F')->setAutoSize(false);
		$sheet->getColumnDimension('F')->setWidth(33.78);
		$sheet->getColumnDimension('G')->setAutoSize(false);
		$sheet->getColumnDimension('G')->setWidth(20.22);
		$sheet->getColumnDimension('H')->setAutoSize(false);
		$sheet->getColumnDimension('H')->setWidth(11.00);
		$sheet->getColumnDimension('I')->setAutoSize(false);
		$sheet->getColumnDimension('I')->setWidth(11.00);
		$sheet->getColumnDimension('J')->setAutoSize(false);
		$sheet->getColumnDimension('J')->setWidth(11.00);
		$sheet->getColumnDimension('K')->setAutoSize(false);
		$sheet->getColumnDimension('K')->setWidth(27.89);



		$sheet->setCellValue('A1','PROPERTY ACKNOWLEDGEMENT RECEIPT');
		//$sheet->setCellValue('A2','END-USER: '. strtoupper($id));
		$sheet->setCellValue('A2','ALL RECORD(S)');
		$sheet->setCellValue('A4','ICS No.');
		$sheet->setCellValue('B4','Qty');
		$sheet->setCellValue('C4','UNIT');
		$sheet->setCellValue('D4','Amount');
		$sheet->setCellValue('D5','Unit Cost');
		$sheet->setCellValue('E5','Total Cost');
		$sheet->setCellValue('F4','Description');
		$sheet->setCellValue('G4','Property Number');
		$sheet->setCellValue('H4','Acquisition Date');
		$sheet->setCellValue('I4','Estimated Useful Life');
		$sheet->setCellValue('J4','End-User');
		$sheet->setCellValue('K4','Remarks');
		$sheet->mergeCells('A4:A5');$sheet->mergeCells('B4:B5');$sheet->mergeCells('C4:C5');$sheet->mergeCells('D4:E4');
		$sheet->mergeCells('F4:F5');$sheet->mergeCells('G4:G5');$sheet->mergeCells('H4:H5');$sheet->mergeCells('I4:I5');
		$sheet->mergeCells('J4:J5');
		$sheet->mergeCells('K4:K5');
		$sheet->getStyle('A4:K5')->getAlignment()->setWrapText(true);
		$sheet->getStyle('A4:K5')->getAlignment()->setHorizontal('center');
		$sheet->getStyle('A4:K5')->getAlignment()->setVertical('center');
		$sheet->getStyle('A1:A2')->applyFromArray($headerfont);
		$sheet->getStyle('A4:K5')->applyFromArray($unitfont);
		$sheet->getStyle('A4:K5')->applyFromArray($allCell);
		$sheet->getStyle('A4:K5')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('3b5998');

		$row=5;
		
		foreach($data as $i)
		{
			$row++;
			$sheet->setCellValue('A'.$row,$i->par_ics_series);
			$sheet->setCellValue('B'.$row,$i->quantity);
			$sheet->setCellValue('C'.$row,$i->unit);
			$sheet->setCellValue('D'.$row,number_format($i->cost, 2, '.', ','));
			$sheet->setCellValue('E'.$row,number_format($i->cost * $i->quantity, 2, '.', ','));
			$sheet->setCellValue('F'.$row,$i->description);
			$sheet->setCellValue('G'.$row,$i->prop_num);
			$sheet->setCellValue('H'.$row,$i->date_receive);
			$sheet->setCellValue('I'.$row,$i->consume_days);
			$sheet->setCellValue('J'.$row,$i->requested_by);
			$sheet->setCellValue('K'.$row,$i->remarks);
			$sheet->getRowDimension($row)->setRowHeight(-1);
			$sheet->getStyle('A'.$row.':K'.$row)->applyFromArray($allCell);
			$sheet->getStyle('A'.$row.':K'.$row)->getAlignment()->setWrapText(true);
			$sheet->getStyle('A'.$row.':K'.$row)->getAlignment()->setVertical('center');
			$sheet->getStyle('J'.$row)->getAlignment()->setHorizontal('center');
			$sheet->getStyle('B'.$row,':C'.$row)->getAlignment()->setHorizontal('center');
			$sheet->getStyle('D'.$row.':E'.$row)->getAlignment()->setHorizontal('right');
		}
		

		$protect = Str::random(10);

		$sheet->getProtection()->setSheet(true);
		$sheet->getProtection()->setSort(true);
		$sheet->getProtection()->setInsertRows(true);
		$sheet->getProtection()->setFormatCells(true);

		$sheet->getProtection()->setPassword($protect);

		$writer = new Xlsx($spreadsheet);
		$writer->save('Inventory Custodian Slip.xlsx');

		$filename="Inventory Custodian Slip.xlsx";
		$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader("Xlsx");
		$spreadsheet = $reader->load("$filename");

		$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Mpdf');

		$pdf_path = 'Inventory Custodian Slip.pdf';
		$writer->save($pdf_path);

		//return redirect('/'.$pdf_path);
		return redirect('/'.$filename);
		
    }

    public function par_cy_user($id)
    {
    	
    	if (is_numeric($id)){

	    	$data = DB::table('summaries')
	    			->where(['summaries.type'=>'ris','summaries.category'=>'PropertyCard','summaries.cy'=>$id])
	    			->orderBy('summaries.created_at','desc')
	    			->get();

	    	$headerfont = array(
		    	'font' 	=> array(
		        'bold'  => true,
		        'color' => array('rgb' => '000000'),
		        'size'  => 15,
		        'name'  => 'Calibri'
		    ));

		    $unitfont = array(
		    	'font'  => array(
		    	'bold'	=> 'true',
		        'color' => array('rgb' => 'ffffff'),
		        'size'  => 11,
		        'name'  => 'Calibri'
		    ));



			$allCell = array(
			      'borders' => array(
			          'allBorders' => array(
			              'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
			              'color' => array('argb' => '000000'),
			          )
			      )
			  );

	    $spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();
		$sheet = $spreadsheet->getActiveSheet()->setTitle('PAR');

		$sheet->getColumnDimension('A')->setAutoSize(false);
		$sheet->getColumnDimension('A')->setWidth(15.56);
		$sheet->getColumnDimension('B')->setAutoSize(false);
		$sheet->getColumnDimension('B')->setWidth(6.22);
		$sheet->getColumnDimension('C')->setAutoSize(false);
		$sheet->getColumnDimension('C')->setWidth(8.33);
		$sheet->getColumnDimension('D')->setAutoSize(false);
		$sheet->getColumnDimension('D')->setWidth(11.00);
		$sheet->getColumnDimension('E')->setAutoSize(false);
		$sheet->getColumnDimension('E')->setWidth(11.33);
		$sheet->getColumnDimension('F')->setAutoSize(false);
		$sheet->getColumnDimension('F')->setWidth(33.78);
		$sheet->getColumnDimension('G')->setAutoSize(false);
		$sheet->getColumnDimension('G')->setWidth(20.22);
		$sheet->getColumnDimension('H')->setAutoSize(false);
		$sheet->getColumnDimension('H')->setWidth(11.00);
		$sheet->getColumnDimension('I')->setAutoSize(false);
		$sheet->getColumnDimension('I')->setWidth(11.00);
		$sheet->getColumnDimension('J')->setAutoSize(false);
		$sheet->getColumnDimension('J')->setWidth(11.00);
		$sheet->getColumnDimension('K')->setAutoSize(false);
		$sheet->getColumnDimension('K')->setWidth(27.89);



		$sheet->setCellValue('A1','PROPERTY ACKNOWLEDGEMENT RECEIPT');
		//$sheet->setCellValue('A2','END-USER: '. strtoupper($id));
		$sheet->setCellValue('A2','ALL RECORD(S)');
		$sheet->setCellValue('A4','ICS No.');
		$sheet->setCellValue('B4','Qty');
		$sheet->setCellValue('C4','UNIT');
		$sheet->setCellValue('D4','Amount');
		$sheet->setCellValue('D5','Unit Cost');
		$sheet->setCellValue('E5','Total Cost');
		$sheet->setCellValue('F4','Description');
		$sheet->setCellValue('G4','Property Number');
		$sheet->setCellValue('H4','Acquisition Date');
		$sheet->setCellValue('I4','Estimated Useful Life');
		$sheet->setCellValue('J4','End-User');
		$sheet->setCellValue('K4','Remarks');
		$sheet->mergeCells('A4:A5');$sheet->mergeCells('B4:B5');$sheet->mergeCells('C4:C5');$sheet->mergeCells('D4:E4');
		$sheet->mergeCells('F4:F5');$sheet->mergeCells('G4:G5');$sheet->mergeCells('H4:H5');$sheet->mergeCells('I4:I5');
		$sheet->mergeCells('J4:J5');
		$sheet->mergeCells('K4:K5');
		$sheet->getStyle('A4:K5')->getAlignment()->setWrapText(true);
		$sheet->getStyle('A4:K5')->getAlignment()->setHorizontal('center');
		$sheet->getStyle('A4:K5')->getAlignment()->setVertical('center');
		$sheet->getStyle('A1:A2')->applyFromArray($headerfont);
		$sheet->getStyle('A4:K5')->applyFromArray($unitfont);
		$sheet->getStyle('A4:K5')->applyFromArray($allCell);
		$sheet->getStyle('A4:K5')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('3b5998');

		$row=5;
		
		foreach($data as $i)
		{
			$row++;
			$sheet->setCellValue('A'.$row,$i->par_ics_series);
			$sheet->setCellValue('B'.$row,$i->quantity);
			$sheet->setCellValue('C'.$row,$i->unit);
			$sheet->setCellValue('D'.$row,number_format($i->cost, 2, '.', ','));
			$sheet->setCellValue('E'.$row,number_format($i->cost * $i->quantity, 2, '.', ','));
			$sheet->setCellValue('F'.$row,$i->description);
			$sheet->setCellValue('G'.$row,$i->prop_num);
			$sheet->setCellValue('H'.$row,$i->date_receive);
			$sheet->setCellValue('I'.$row,$i->consume_days);
			$sheet->setCellValue('J'.$row,$i->requested_by);
			$sheet->setCellValue('K'.$row,$i->remarks);
			$sheet->getRowDimension($row)->setRowHeight(-1);
			$sheet->getStyle('A'.$row.':K'.$row)->applyFromArray($allCell);
			$sheet->getStyle('A'.$row.':K'.$row)->getAlignment()->setWrapText(true);
			$sheet->getStyle('A'.$row.':K'.$row)->getAlignment()->setVertical('center');
			$sheet->getStyle('J'.$row)->getAlignment()->setHorizontal('center');
			$sheet->getStyle('B'.$row,':C'.$row)->getAlignment()->setHorizontal('center');
			$sheet->getStyle('D'.$row.':E'.$row)->getAlignment()->setHorizontal('right');
		}
			

			$protect = Str::random(10);

			$sheet->getProtection()->setSheet(true);
			$sheet->getProtection()->setSort(true);
			$sheet->getProtection()->setInsertRows(true);
			$sheet->getProtection()->setFormatCells(true);

			$sheet->getProtection()->setPassword($protect);

			$writer = new Xlsx($spreadsheet);
			$writer->save('Property Acknowledgement Receipt.xlsx');

			$filename="Property Acknowledgement Receipt.xlsx";
			$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader("Xlsx");
			$spreadsheet = $reader->load("$filename");

			$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Mpdf');

			$pdf_path = 'Property Acknowledgement Receipt.pdf';
			$writer->save($pdf_path);

			//return redirect('/'.$pdf_path);
			return redirect('/'.$filename);
		}else{

		$data = DB::table('summaries')
	    			->where(['summaries.type'=>'ris','summaries.category'=>'PropertyCard','summaries.requested_by'=>$id])
	    			->orderBy('summaries.created_at','desc')
	    			->get();

	    	$headerfont = array(
		    	'font' 	=> array(
		        'bold'  => true,
		        'color' => array('rgb' => '000000'),
		        'size'  => 15,
		        'name'  => 'Calibri'
		    ));

		    $unitfont = array(
		    	'font'  => array(
		    	'bold'	=> 'true',
		        'color' => array('rgb' => 'ffffff'),
		        'size'  => 11,
		        'name'  => 'Calibri'
		    ));



			$allCell = array(
			      'borders' => array(
			          'allBorders' => array(
			              'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
			              'color' => array('argb' => '000000'),
			          )
			      )
			  );

	    $spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();

		$sheet->getColumnDimension('A')->setAutoSize(false);
		$sheet->getColumnDimension('A')->setWidth(15.56);
		$sheet->getColumnDimension('B')->setAutoSize(false);
		$sheet->getColumnDimension('B')->setWidth(6.22);
		$sheet->getColumnDimension('C')->setAutoSize(false);
		$sheet->getColumnDimension('C')->setWidth(8.33);
		$sheet->getColumnDimension('D')->setAutoSize(false);
		$sheet->getColumnDimension('D')->setWidth(11.00);
		$sheet->getColumnDimension('E')->setAutoSize(false);
		$sheet->getColumnDimension('E')->setWidth(11.33);
		$sheet->getColumnDimension('F')->setAutoSize(false);
		$sheet->getColumnDimension('F')->setWidth(33.78);
		$sheet->getColumnDimension('G')->setAutoSize(false);
		$sheet->getColumnDimension('G')->setWidth(20.22);
		$sheet->getColumnDimension('H')->setAutoSize(false);
		$sheet->getColumnDimension('H')->setWidth(11.00);
		$sheet->getColumnDimension('I')->setAutoSize(false);
		$sheet->getColumnDimension('I')->setWidth(11.00);
		$sheet->getColumnDimension('J')->setAutoSize(false);
		$sheet->getColumnDimension('J')->setWidth(11.00);
		$sheet->getColumnDimension('K')->setAutoSize(false);
		$sheet->getColumnDimension('K')->setWidth(27.89);



		$sheet->setCellValue('A1','INVENTORY CUSTODIAN SLIP');
		//$sheet->setCellValue('A2','END-USER: '. strtoupper($id));
		$sheet->setCellValue('A2','ALL RECORD(S)');
		$sheet->setCellValue('A4','ICS No.');
		$sheet->setCellValue('B4','Qty');
		$sheet->setCellValue('C4','UNIT');
		$sheet->setCellValue('D4','Amount');
		$sheet->setCellValue('D5','Unit Cost');
		$sheet->setCellValue('E5','Total Cost');
		$sheet->setCellValue('F4','Description');
		$sheet->setCellValue('G4','Property Number');
		$sheet->setCellValue('H4','Acquisition Date');
		$sheet->setCellValue('I4','Estimated Useful Life');
		$sheet->setCellValue('J4','End-User');
		$sheet->setCellValue('K4','Remarks');
		$sheet->mergeCells('A4:A5');$sheet->mergeCells('B4:B5');$sheet->mergeCells('C4:C5');$sheet->mergeCells('D4:E4');
		$sheet->mergeCells('F4:F5');$sheet->mergeCells('G4:G5');$sheet->mergeCells('H4:H5');$sheet->mergeCells('I4:I5');
		$sheet->mergeCells('J4:J5');
		$sheet->mergeCells('K4:K5');
		$sheet->getStyle('A4:K5')->getAlignment()->setWrapText(true);
		$sheet->getStyle('A4:K5')->getAlignment()->setHorizontal('center');
		$sheet->getStyle('A4:K5')->getAlignment()->setVertical('center');
		$sheet->getStyle('A1:A2')->applyFromArray($headerfont);
		$sheet->getStyle('A4:K5')->applyFromArray($unitfont);
		$sheet->getStyle('A4:K5')->applyFromArray($allCell);
		$sheet->getStyle('A4:K5')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('3b5998');

		$row=5;
		
		foreach($data as $i)
		{
			$row++;
			$sheet->setCellValue('A'.$row,$i->par_ics_series);
			$sheet->setCellValue('B'.$row,$i->quantity);
			$sheet->setCellValue('C'.$row,$i->unit);
			$sheet->setCellValue('D'.$row,number_format($i->cost, 2, '.', ','));
			$sheet->setCellValue('E'.$row,number_format($i->cost * $i->quantity, 2, '.', ','));
			$sheet->setCellValue('F'.$row,$i->description);
			$sheet->setCellValue('G'.$row,$i->prop_num);
			$sheet->setCellValue('H'.$row,$i->date_receive);
			$sheet->setCellValue('I'.$row,$i->consume_days);
			$sheet->setCellValue('J'.$row,$i->requested_by);
			$sheet->setCellValue('K'.$row,$i->remarks);
			$sheet->getRowDimension($row)->setRowHeight(-1);
			$sheet->getStyle('A'.$row.':K'.$row)->applyFromArray($allCell);
			$sheet->getStyle('A'.$row.':K'.$row)->getAlignment()->setWrapText(true);
			$sheet->getStyle('A'.$row.':K'.$row)->getAlignment()->setVertical('center');
			$sheet->getStyle('J'.$row)->getAlignment()->setHorizontal('center');
			$sheet->getStyle('B'.$row,':C'.$row)->getAlignment()->setHorizontal('center');
			$sheet->getStyle('D'.$row.':E'.$row)->getAlignment()->setHorizontal('right');
		}
			

			$protect = Str::random(10);

			$sheet->getProtection()->setSheet(true);
			$sheet->getProtection()->setSort(true);
			$sheet->getProtection()->setInsertRows(true);
			$sheet->getProtection()->setFormatCells(true);

			$sheet->getProtection()->setPassword($protect);

			$writer = new Xlsx($spreadsheet);
			$writer->save('Property Acknowledgement Receipt.xlsx');

			$filename="Property Acknowledgement Receipt.xlsx";
			$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader("Xlsx");
			$spreadsheet = $reader->load("$filename");

			$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Mpdf');

			$pdf_path = 'Property Acknowledgement Receipt.pdf';
			$writer->save($pdf_path);

			//return redirect('/'.$pdf_path);
			return redirect('/'.$filename);
			
		}
	}

	public function par_cy_user_export($user,$cy){
		$data = DB::table('summaries')
	    			->where(['summaries.type'=>'ris','summaries.category'=>'PropertyCard','summaries.cy'=>$cy,'summaries.requested_by'=>$user])
	    			->orderBy('summaries.created_at','desc')
	    			->get();

	    	$headerfont = array(
		    	'font' 	=> array(
		        'bold'  => true,
		        'color' => array('rgb' => '000000'),
		        'size'  => 15,
		        'name'  => 'Calibri'
		    ));

		    $unitfont = array(
		    	'font'  => array(
		    	'bold'	=> 'true',
		        'color' => array('rgb' => 'ffffff'),
		        'size'  => 11,
		        'name'  => 'Calibri'
		    ));



			$allCell = array(
			      'borders' => array(
			          'allBorders' => array(
			              'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
			              'color' => array('argb' => '000000'),
			          )
			      )
			  );

	    $spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();
		$sheet = $spreadsheet->getActiveSheet()->setTitle('PAR');

		$sheet->getColumnDimension('A')->setAutoSize(false);
		$sheet->getColumnDimension('A')->setWidth(15.56);
		$sheet->getColumnDimension('B')->setAutoSize(false);
		$sheet->getColumnDimension('B')->setWidth(6.22);
		$sheet->getColumnDimension('C')->setAutoSize(false);
		$sheet->getColumnDimension('C')->setWidth(8.33);
		$sheet->getColumnDimension('D')->setAutoSize(false);
		$sheet->getColumnDimension('D')->setWidth(11.00);
		$sheet->getColumnDimension('E')->setAutoSize(false);
		$sheet->getColumnDimension('E')->setWidth(11.33);
		$sheet->getColumnDimension('F')->setAutoSize(false);
		$sheet->getColumnDimension('F')->setWidth(33.78);
		$sheet->getColumnDimension('G')->setAutoSize(false);
		$sheet->getColumnDimension('G')->setWidth(20.22);
		$sheet->getColumnDimension('H')->setAutoSize(false);
		$sheet->getColumnDimension('H')->setWidth(11.00);
		$sheet->getColumnDimension('I')->setAutoSize(false);
		$sheet->getColumnDimension('I')->setWidth(11.00);
		$sheet->getColumnDimension('J')->setAutoSize(false);
		$sheet->getColumnDimension('J')->setWidth(11.00);
		$sheet->getColumnDimension('K')->setAutoSize(false);
		$sheet->getColumnDimension('K')->setWidth(27.89);



		$sheet->setCellValue('A1','PROPERTY ACKNOWLEDGEMENT RECEIPT');
		//$sheet->setCellValue('A2','END-USER: '. strtoupper($id));
		$sheet->setCellValue('A2','ALL RECORD(S)');
		$sheet->setCellValue('A4','ICS No.');
		$sheet->setCellValue('B4','Qty');
		$sheet->setCellValue('C4','UNIT');
		$sheet->setCellValue('D4','Amount');
		$sheet->setCellValue('D5','Unit Cost');
		$sheet->setCellValue('E5','Total Cost');
		$sheet->setCellValue('F4','Description');
		$sheet->setCellValue('G4','Property Number');
		$sheet->setCellValue('H4','Acquisition Date');
		$sheet->setCellValue('I4','Estimated Useful Life');
		$sheet->setCellValue('J4','End-User');
		$sheet->setCellValue('K4','Remarks');
		$sheet->mergeCells('A4:A5');$sheet->mergeCells('B4:B5');$sheet->mergeCells('C4:C5');$sheet->mergeCells('D4:E4');
		$sheet->mergeCells('F4:F5');$sheet->mergeCells('G4:G5');$sheet->mergeCells('H4:H5');$sheet->mergeCells('I4:I5');
		$sheet->mergeCells('J4:J5');
		$sheet->mergeCells('K4:K5');
		$sheet->getStyle('A4:K5')->getAlignment()->setWrapText(true);
		$sheet->getStyle('A4:K5')->getAlignment()->setHorizontal('center');
		$sheet->getStyle('A4:K5')->getAlignment()->setVertical('center');
		$sheet->getStyle('A1:A2')->applyFromArray($headerfont);
		$sheet->getStyle('A4:K5')->applyFromArray($unitfont);
		$sheet->getStyle('A4:K5')->applyFromArray($allCell);
		$sheet->getStyle('A4:K5')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('3b5998');

		$row=5;
		
		foreach($data as $i)
		{
			$row++;
			$sheet->setCellValue('A'.$row,$i->par_ics_series);
			$sheet->setCellValue('B'.$row,$i->quantity);
			$sheet->setCellValue('C'.$row,$i->unit);
			$sheet->setCellValue('D'.$row,number_format($i->cost, 2, '.', ','));
			$sheet->setCellValue('E'.$row,number_format($i->cost * $i->quantity, 2, '.', ','));
			$sheet->setCellValue('F'.$row,$i->description);
			$sheet->setCellValue('G'.$row,$i->prop_num);
			$sheet->setCellValue('H'.$row,$i->date_receive);
			$sheet->setCellValue('I'.$row,$i->consume_days);
			$sheet->setCellValue('J'.$row,$i->requested_by);
			$sheet->setCellValue('K'.$row,$i->remarks);
			$sheet->getRowDimension($row)->setRowHeight(-1);
			$sheet->getStyle('A'.$row.':K'.$row)->applyFromArray($allCell);
			$sheet->getStyle('A'.$row.':K'.$row)->getAlignment()->setWrapText(true);
			$sheet->getStyle('A'.$row.':K'.$row)->getAlignment()->setVertical('center');
			$sheet->getStyle('J'.$row)->getAlignment()->setHorizontal('center');
			$sheet->getStyle('B'.$row,':C'.$row)->getAlignment()->setHorizontal('center');
			$sheet->getStyle('D'.$row.':E'.$row)->getAlignment()->setHorizontal('right');
		}
			
			$protect = Str::random(10);

			$sheet->getProtection()->setSheet(true);
			$sheet->getProtection()->setSort(true);
			$sheet->getProtection()->setInsertRows(true);
			$sheet->getProtection()->setFormatCells(true);

			$sheet->getProtection()->setPassword($protect);

			$writer = new Xlsx($spreadsheet);
			$writer->save('Property Acknowledgement Receipt.xlsx');

			$filename="Property Acknowledgement Receipt.xlsx";
			$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader("Xlsx");
			$spreadsheet = $reader->load("$filename");

			$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Mpdf');

			$pdf_path = 'Property Acknowledgement Receipt.pdf';
			$writer->save($pdf_path);

			//return redirect('/'.$pdf_path);
			return redirect('/'.$filename);
	}

	public function rsmi_report($id)
	{

	//echo($id);

		$data = DB::table('summaries')
    				->where(['summaries.type'=>'ris','summaries.date_receive'=>$id])
    				->select(DB::raw('summaries.ris_num as ris'),DB::raw('summaries.respo_center as respocode'),DB::raw('summaries.stock_number as stock'), DB::raw('summaries.description as description'),DB::raw('summaries.unit as unit'), DB::raw('sum(summaries.quantity) as totalquantity'),DB::raw('summaries.cost as cost'),DB::raw('summaries.papcode as papcode'))
    				->groupBy(DB::raw('summaries.stock_number'))
    				->get();

    	$receive_date = Carbon::parse($id)->format('F j, Y');

    	$authsig = DB::table('sign_settings')
    				->get();

		$headerfont = array(
	    	'font' 	=> array(
	        'bold'  => true,
	        'color' => array('rgb' => '000000'),
	        'size'  => 12,
	        'name'  => 'Cambria'
	    ));

	    $headerTitlefont = array(
	    	'font' 	=> array(
	        'bold'  => true,
	        'color' => array('rgb' => 'ffffff'),
	        'size'  => 11,
	        'name'  => 'Cambria'
	    ));

	    $agencyfont = array(
	    	'font' 	=> array(
	        'italic'  => true,
	        'color' => array('rgb' => '000000'),
	        'size'  => 11,
	        'name'  => 'Cambria'
	    ));

	    $unitfont = array(
	    	'font'  => array(
	        'color' => array('rgb' => '000000'),
	        'size'  => 11,
	        'name'  => 'Cambria'
	    ));

	    $sheetfont = array(
	    	'font'  => array(
	        'color' => array('rgb' => '000000'),
	        'size'  => 11,
	        'name'  => 'Cambria'
	    ));



		$allCell = array(
		      'borders' => array(
		          'allBorders' => array(
		              'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
		              'color' => array('argb' => '000000'),
		          )
		      )
		  );

		$borderThinDouble = array(
		    'borders' => array(
		        'outline' => array(
		            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_DOUBLE,
		            'color' => array('argb' => '000000'),
		        ),
		    ),
		);

		$borderThin = array(
		    'borders' => array(
		        'outline' => array(
		            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
		            'color' => array('argb' => '000000'),
		        ),
		    ),
		);

		$borderMedium = array(
		    'borders' => array(
		        'outline' => array(
		            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM,
		            'color' => array('argb' => '000000'),
		        ),
		    ),
		);

		$borderBottomDouble = array(
		    'borders' => array(
		        'bottom' => array(
		            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_DOUBLE,
		            'color' => array('argb' => '000000'),
		        ),
		    ),
		);

		$borderBottomThin = array(
		    'borders' => array(
		        'bottom' => array(
		            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
		            'color' => array('argb' => '000000'),
		        ),
		    ),
		);

    	$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();
		$sheet = $spreadsheet->getActiveSheet()->setTitle('RSMI');

		$sheet->getColumnDimension('A')->setAutoSize(false);
		$sheet->getColumnDimension('A')->setWidth(9.56);
		$sheet->getColumnDimension('B')->setAutoSize(false);
		$sheet->getColumnDimension('B')->setWidth(16.89);
		$sheet->getColumnDimension('C')->setAutoSize(false);
		$sheet->getColumnDimension('C')->setWidth(12.67);
		$sheet->getColumnDimension('D')->setAutoSize(false);
		$sheet->getColumnDimension('D')->setWidth(22.33);
		$sheet->getColumnDimension('E')->setAutoSize(false);
		$sheet->getColumnDimension('E')->setWidth(8.33);
		$sheet->getColumnDimension('F')->setAutoSize(false);
		$sheet->getColumnDimension('F')->setWidth(9.33);
		$sheet->getColumnDimension('G')->setAutoSize(false);
		$sheet->getColumnDimension('G')->setWidth(13.89);
		$sheet->getColumnDimension('H')->setAutoSize(false);
		$sheet->getColumnDimension('H')->setWidth(19.23);

		$sheet->setCellValue('A3','REPORT OF SUPPLIES AND MATERIALS');
		$sheet->setCellValue('A4','Mindanao Development Authority (MinDA)');
		$sheet->setCellValue('A5','Agency');
		$sheet->mergeCells('A3:H3');$sheet->mergeCells('A4:H4');$sheet->mergeCells('A5:H5');
		$sheet->getStyle('A3:H5')->getAlignment()->setHorizontal('center');
		$sheet->getStyle('A3:H3')->applyFromArray($headerfont);
		$sheet->getStyle('A4:H4')->applyFromArray($agencyfont);
		$sheet->getStyle('A5:H5')->applyFromArray($unitfont);
		$sheet->setCellValue('A7','Date:');
		$newDateFormat = \Carbon\Carbon::parse($receive_date)->format('l, F j, Y');
		$sheet->setCellValue('B7',$newDateFormat);
		$sheet->getStyle('B7')->applyFromArray($borderBottomThin);
		$sheet->setCellValue('G7','No.:');
		$sheet->setCellValue('H7',$data[0]->ris);
		$sheet->getStyle('H7')->applyFromArray($borderBottomThin);
		$sheet->setCellValue('A9','To be filled up in the Supply and Property Unit');
		$sheet->setCellValue('G9','To be filled up in the Accounting Unit');
		$sheet->mergeCells('A9:F9');$sheet->mergeCells('G9:H9');$sheet->getStyle('A9:H9')->getAlignment()->setHorizontal('center');
		$sheet->getStyle('A9:H9')->applyFromArray($agencyfont);
		$sheet->setCellValue('A10','RIS NO:');$sheet->setCellValue('B10','RESPONSIBILITY CODE');$sheet->setCellValue('C10','STOCK NO');
		$sheet->setCellValue('D10','ITEM');$sheet->setCellValue('E10','UNIT');$sheet->setCellValue('F10','QTY ISSUED');
		$sheet->setCellValue('G10','UNIT COST');$sheet->setCellValue('H10','AMOUNT');
		$sheet->getStyle('A10:H10')->applyFromArray($headerTitlefont);
		$sheet->getStyle('A10:H10')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('3b5998');
		$sheet->getStyle('A10:H10')->getAlignment()->setHorizontal('center');
		$sheet->getStyle('A10:H10')->getAlignment()->setVertical('center');
		$sheet->getStyle('A10:H10')->getAlignment()->setWrapText(true);

		$row=11;
		foreach($data as $i)
		{
			$sheet->setCellValue('A'.$row,$i->ris);
			$sheet->setCellValue('B'.$row,$i->respocode);
			$sheet->setCellValue('C'.$row,$i->stock);
			$sheet->setCellValue('D'.$row,$i->description);
			$sheet->setCellValue('E'.$row,$i->unit);
			$sheet->setCellValue('F'.$row,$i->totalquantity);
			$sheet->setCellValue('G'.$row,number_format($i->cost, 2, '.', ','));
			$sheet->setCellValue('H'.$row,number_format($i->cost * $i->totalquantity, 2, '.', ','));
			$sheet->getStyle('A11:H'.$row)->getAlignment()->setWrapText(true);
			$sheet->getStyle('G'.$row.':H'.$row)->getAlignment()->setHorizontal('right');
			$sheet->getStyle('A11:H'.$row)->getAlignment()->setVertical('center');
			$row++;
		}

		
		$sheet->getStyle('A10:H'.$row)->applyFromArray($allCell);
		$sheet->getStyle('A'.$row.':H'.$row)->applyFromArray($borderBottomDouble);
		$row=(int)$row+1;
		$sheet->setCellValue('B'.$row,'Recapitulation');
		$sheet->mergeCells('B'.$row.':G'.$row);
		$sheet->getStyle('B'.$row.':G'.$row)->getAlignment()->setHorizontal('center');
		$sheet->getStyle('B'.$row.':G'.$row)->applyFromArray($allCell);
		$sheet->getStyle('B'.$row)->applyFromArray($agencyfont);
		$row=(int)$row+1;
		$sheet->setCellValue('B'.$row,'Stock No.');$sheet->setCellValue('C'.$row,'Quantity');$sheet->setCellValue('D'.$row,'Description');
		$sheet->setCellValue('E'.$row,'Unit Cost');$sheet->setCellValue('F'.$row,'Total Cost');$sheet->setCellValue('G'.$row,'Account Code');
		$sheet->getStyle('B'.$row.':G'.$row)->applyFromArray($allCell);
		$sheet->getStyle('B'.$row.':G'.$row)->getAlignment()->setHorizontal('center');
		$sheet->getStyle('B'.$row.':G'.$row)->applyFromArray($agencyfont);

		foreach($data as $d)
		{
			$row++;
			$sheet->setCellValue('B'.$row,$d->stock);
			$sheet->setCellValue('C'.$row,$d->totalquantity);
			$sheet->setCellValue('D'.$row,nl2br($d->description));
			$sheet->setCellValue('E'.$row,number_format($d->cost, 2, '.', ','));
			$sheet->setCellValue('F'.$row,number_format($d->cost * $d->totalquantity, 2, '.', ','));
			$sheet->setCellValue('G'.$row,$d->papcode);
			$sheet->getStyle('B'.$row.':G'.$row)->applyFromArray($allCell);
			$sheet->getStyle('B'.$row.':G'.$row)->getAlignment()->setWrapText(true);
			$sheet->getStyle('E'.$row.':F'.$row)->getAlignment()->setHorizontal('right');
			$sheet->getStyle('E'.$row.':F'.$row)->getAlignment()->setVertical('right');

		}

		$row=(int)$row+2;
		$srow=(int)$row;
		$sheet->setCellValue('A'.$row,'      I hereby certify to the correctness of the abovementioned information');
		$sheet->setCellValue('F'.$row,'POSTED BY/DATE');
		$row=(int)$row+4;
		$sheet->setCellValue('A'.$row,$authsig[0]->IARSupplyOfficer);
		$sheet->setCellValue('F'.$row,strtoupper($authsig[0]->RSMIAccClerk));
		//$sheet->setCellValue('F'.$row,$lists[0]->postedby.' / '.Carbon::parse($data[0]->date_posted)->format('n/j/Y'));
		//$sheet->setCellValue('F'.$row,$lists[0]->postedby.' / '.Carbon::parse($data[0]->date_posted)->format('n/j/Y'));
		$sheet->mergeCells('A'.$row.':E'.$row);
		$sheet->mergeCells('F'.$row.':H'.$row);
		$sheet->getStyle('B'.$row.':D'.$row)->applyFromArray($borderBottomThin);
		$sheet->getStyle('F'.$row.':H'.$row)->applyFromArray($borderBottomThin);
		$sheet->getStyle('A'.$row.':H'.$row)->getAlignment()->setHorizontal('center');
		$sheet->getStyle('A'.$row.':H'.$row)->applyFromArray($headerfont);

		$row=(int)$row+1;
		$sheet->setCellValue('A'.$row,$authsig[0]->IARSupplyOfficerPos);
		$sheet->setCellValue('F'.$row,'Accounting Clerk');
		$sheet->mergeCells('A'.$row.':E'.$row);
		$sheet->mergeCells('F'.$row.':H'.$row);
		$sheet->getStyle('A'.$row.':H'.$row)->getAlignment()->setHorizontal('center');
		
		$row=(int)$row+1;

		$sheet->getStyle('A'.$srow.':E'.$row)->applyFromArray($borderThin);
		$sheet->getStyle('F'.$srow.':H'.$row)->applyFromArray($borderThin);
		$sheet->getStyle('A9'.':H'.$row)->applyFromArray($borderMedium);

		$sheet->getStyle('A9:F9')->applyFromArray($borderThinDouble);$sheet->getStyle('G9:H9')->applyFromArray($borderThinDouble);

		$protect = Str::random(10);

			$sheet->getProtection()->setSheet(true);
			$sheet->getProtection()->setSort(true);
			$sheet->getProtection()->setInsertRows(true);
			$sheet->getProtection()->setFormatCells(true);

			$sheet->getProtection()->setPassword($protect);

			
			$writer = new Xlsx($spreadsheet);
			$writer->save('Report of Supplies and Materials.xlsx');

			$filename="Report of Supplies and Materials.xlsx";
			$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader("Xlsx");
			$spreadsheet = $reader->load("$filename");

			$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Mpdf');

			$pdf_path = 'Report of Supplies and Materials.pdf';
			$writer->save($pdf_path);

			//return redirect('/'.$pdf_path);
			return redirect('/'.$filename);
	}

	public function waste_materials_report($id)
 	{
 		$lists = DB::table('waste__materials')
    					->join('waste__material__details','waste__material__details.wm_id','waste__materials.id')
    					->where(['waste__material__details.wm_id'=>$id,'waste__materials.id'=>$id])
    					->orderBy('waste__material__details.created_at','desc')
    					->get();

    	$headerfont = array(
	    	'font' 	=> array(
	        'bold'  => true,
	        'color' => array('rgb' => '000000'),
	        'size'  => 14,
	        'name'  => 'Cambria'
	    ));

	    $headerTitlefont = array(
	    	'font' 	=> array(
	        'italic'=> true,
	        'color' => array('rgb' => '000000'),
	        'size'  => 14,
	        'name'  => 'Cambria'
	    ));

	    $signaturefont = array(
	    	'font' 	=> array(
	        'bold'  => true,
	        'color' => array('rgb' => '000000'),
	        'size'  => 11,
	        'name'  => 'Times New Roman'
	    ));

	    $agencyfont = array(
	    	'font' 	=> array(
	        'italic'  => true,
	        'color' => array('rgb' => '000000'),
	        'size'  => 11,
	        'name'  => 'Cambria'
	    ));

	    $unitfont = array(
	    	'font'  => array(
	        'color' => array('rgb' => '000000'),
	        'size'  => 12,
	        'name'  => 'Cambria'
	    ));

	    $sheetfont = array(
	    	'font'  => array(
	        'color' => array('rgb' => '000000'),
	        'name'  => 'Cambria'
	    ));

	    $entityfont = array(
	    	'font'  => array(
	        'color' => array('rgb' => '000000'),
	        'size'  => 11,
	        'name'  => 'Cambria'
	    ));




		$allCell = array(
		      'borders' => array(
		          'allBorders' => array(
		              'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
		              'color' => array('argb' => '000000'),
		          )
		      )
		  );

		$borderMedium = array(
		    'borders' => array(
		        'outline' => array(
		            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM,
		            'color' => array('argb' => '000000'),
		        ),
		    ),
		);

		$borderThin = array(
		    'borders' => array(
		        'outline' => array(
		            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
		            'color' => array('argb' => '000000'),
		        ),
		    ),
		);

		$borderBottomThin = array(
		    'borders' => array(
		        'bottom' => array(
		            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
		            'color' => array('argb' => '000000'),
		        ),
		    ),
		);

		$forcheck = array(
	    	'font'  	=> array(
	        'bold'  => true,
	        'color' => array('rgb' => '000000'),
	        'size'  => 12,
	        'name'  => 'Wingdings 2'
	    ));


 		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();
		$sheet = $spreadsheet->getActiveSheet()->setTitle('WM');

		$sheet->getColumnDimension('A')->setAutoSize(false);
		$sheet->getColumnDimension('A')->setWidth(8.11);
		$sheet->getColumnDimension('B')->setAutoSize(false);
		$sheet->getColumnDimension('B')->setWidth(8.11);
		$sheet->getColumnDimension('C')->setAutoSize(false);
		$sheet->getColumnDimension('C')->setWidth(8.11);
		$sheet->getColumnDimension('D')->setAutoSize(false);
		$sheet->getColumnDimension('D')->setWidth(8.11);
		$sheet->getColumnDimension('E')->setAutoSize(false);
		$sheet->getColumnDimension('E')->setWidth(8.11);
		$sheet->getColumnDimension('F')->setAutoSize(false);
		$sheet->getColumnDimension('F')->setWidth(13.78);
		$sheet->getColumnDimension('G')->setAutoSize(false);
		$sheet->getColumnDimension('G')->setWidth(10.11);
		$sheet->getColumnDimension('H')->setAutoSize(false);
		$sheet->getColumnDimension('H')->setWidth(11.11);
		$sheet->getColumnDimension('I')->setAutoSize(false);
		$sheet->getColumnDimension('I')->setWidth(15.33);

		$sheet->setCellValue('I2','Appendix 65');
		$sheet->setCellValue('A3','WM NO.');
		$sheet->setCellValue('B3',$lists[0]->wm_num);
		$sheet->setCellValue('A5','WASTE MATERIALS REPORT');
		$sheet->setCellValue('A7','Entity Name : '.$lists[0]->entity_name);
		$sheet->setCellValue('H7','Fund Cluster : '.$lists[0]->cluster);
		$sheet->setCellValue('A8','Place of Storage :  '.$lists[0]->storage);
		$sheet->setCellValue('H8','Date :  '.Carbon::parse($lists[0]->wm_date)->format('n/j/Y'));
		$sheet->setCellValue('A9','ITEMS FOR DISPOSAL');
		$sheet->setCellValue('A10','Item');$sheet->setCellValue('B10','Quantity');$sheet->setCellValue('C10','Unit');
		$sheet->setCellValue('D10','Description');
		$sheet->setCellValue('G10','Record of Sales');
		$sheet->setCellValue('G11','Official Receipt');
		$sheet->setCellValue('G12','No.');$sheet->setCellValue('H12','Date');$sheet->setCellValue('I12','Amount');

		$row=12;
		$total=0;
		foreach ($lists as $i) {
			$row++;
			$sheet->setCellValue('A'.$row,$i->item);
			$sheet->setCellValue('B'.$row,$i->quantity);
			$sheet->setCellValue('C'.$row,$i->unit);
			$sheet->setCellValue('D'.$row,$i->description);
			$sheet->setCellValue('G'.$row,$i->receipt_num);
			$sheet->setCellValue('H'.$row,Carbon::parse($i->receipt_date)->format('n/j/Y'));
			$sheet->setCellValue('I'.$row,number_format($i->amount, 2, '.', ','));
			$sheet->mergeCells('D'.$row.':F'.$row);
			$sheet->getStyle('H'.$row.':I'.$row)->getAlignment()->setHorizontal('right');
			$sheet->getStyle('D'.$row.':F'.$row)->applyFromArray($allCell);
			$sheet->getStyle('D'.$row)->getAlignment()->setWrapText(true);
			$total = (double)$total + (double)$i->amount;
			$sheet->getStyle('A'.$row.':I'.$row)->applyFromArray($sheetfont);
		}

		$rowend = (int)$row+4;
		$rowstart = (int)$row;
		$sheet->getStyle('A8:I12')->applyFromArray($allCell);
		$sheet->getStyle('A12:C'.$rowend)->applyFromArray($allCell);
		$sheet->getStyle('G12:I'.$rowend)->applyFromArray($allCell);
		$sheet->getStyle('A8:I'.$rowend)->applyFromArray($borderMedium);
		$sheet->getStyle('A9:I9')->applyFromArray($borderMedium);
		$sheet->getStyle('A10:I12')->applyFromArray($borderMedium);
		$sheet->getStyle('I2')->applyFromArray($headerTitlefont);
		$sheet->getStyle('A3')->applyFromArray($unitfont);
		$sheet->getStyle('A5')->applyFromArray($headerfont);
		$sheet->getStyle('A7:I7')->applyFromArray($signaturefont);
		$sheet->getStyle('A9')->applyFromArray($headerfont);
		$sheet->getStyle('A10:I12')->applyFromArray($signaturefont);

		$sheet->mergeCells('A7:F7');$sheet->mergeCells('A8:G8');$sheet->mergeCells('A9:I9');
		$sheet->mergeCells('A10:A12');$sheet->mergeCells('B10:B12');$sheet->mergeCells('C10:C12');$sheet->mergeCells('D10:F12');
		$sheet->mergeCells('G10:I10');$sheet->mergeCells('G11:I11');

		$sheet->getStyle('A10:I12')->getAlignment()->setHorizontal('center');
		$sheet->getStyle('A10:I12')->getAlignment()->setVertical('center');

		$rowend1 = (int)$row+1;
		$sheet->getStyle('D'.$rowend1.':F'.$rowend1)->applyFromArray($borderThin);
		$rowend1 = (int)$row+2;
		$sheet->getStyle('D'.$rowend1.':F'.$rowend1)->applyFromArray($borderThin);
		$rowend1 = (int)$row+3;
		$sheet->getStyle('D'.$rowend1.':F'.$rowend1)->applyFromArray($borderThin);
		$rowend1 = (int)$row+4;
		$sheet->getStyle('D'.$rowend1.':F'.$rowend1)->applyFromArray($borderThin);
		$sheet->getStyle('A8:I'.$rowend)->applyFromArray($borderMedium);
		$sheet->mergeCells('D'.$rowend1.':F'.$rowend1);$sheet->setCellValue('D'.$rowend1,'TOTAL');
		$sheet->getStyle('D'.$rowend1.':F'.$rowend1)->applyFromArray($signaturefont);
		$sheet->getStyle('D'.$rowend1.':F'.$rowend1)->getAlignment()->setHorizontal('center');
		$sheet->setCellValue('I'.$rowend1,number_format($total, 2, '.', ','));
		$sheet->getStyle('I'.$rowend1)->getAlignment()->setHorizontal('right');

		$row=(int)$row+5;
		$bstart=(int)$row;
		$sheet->setCellValue('A'.$row,'Certified Correct :');
		$sheet->setCellValue('F'.$row,'Disposal Approved :');
		$sheet->getStyle('A'.$row.':I'.$row)->applyFromArray($sheetfont);

		$row=(int)$row+4;
		$sheet->setCellValue('B'.$row,strtoupper($lists[0]->custodian));
		$sheet->setCellValue('G'.$row,strtoupper($lists[0]->agency_head));
		$sheet->mergeCells('B'.$row.':D'.$row);$sheet->mergeCells('G'.$row.':I'.$row);
		$sheet->getStyle('B'.$row.':I'.$row)->getAlignment()->setHorizontal('center');
		$sheet->getStyle('B'.$row.':D'.$row)->applyFromArray($signaturefont);
		$sheet->getStyle('G'.$row.':I'.$row)->applyFromArray($signaturefont);
		$sheet->getStyle('B'.$row.':D'.$row)->applyFromArray($borderBottomThin);
		$sheet->getStyle('G'.$row.':I'.$row)->applyFromArray($borderBottomThin);

		$row=(int)$row+1;
		$rowstart2=(int)$row;
		$sheet->setCellValue('B'.$row,'Signature over Printed Name of Supply and/or Property Custodian');
		$sheet->mergeCells('B'.$row.':D'.$row);
		$sheet->getStyle('B'.$row.':D'.$row)->getAlignment()->setWrapText(true);
		$sheet->setCellValue('G'.$row,'Signature over Printed Name of Head of Agency/Entity or his/her Authorized Representative');
		$sheet->mergeCells('G'.$row.':I'.$row);
		$sheet->getStyle('G'.$row.':I'.$row)->getAlignment()->setWrapText(true);
		$sheet->getRowDimension($row)->setRowHeight(42.60);
		$sheet->getStyle('B'.$row.':I'.$row)->getAlignment()->setHorizontal('center');
		$sheet->getStyle('A'.$row.':I'.$row)->applyFromArray($sheetfont);

		$row=(int)$row+1;
		$sheet->setCellValue('A'.$row,'CERTIFICATE OF INSPECTION');
		$sheet->mergeCells('A'.$row.':I'.$row);
		$sheet->getStyle('A'.$row.':I'.$row)->getAlignment()->setHorizontal('center');
		$sheet->getStyle('A'.$row.':I'.$row)->applyFromArray($signaturefont);
		$sheet->getStyle('A'.$row.':I'.$row)->applyFromArray($borderMedium);

		$row=(int)$row+2;
		$sheet->setCellValue('A'.$row,'          I hereby certify that the property enumerated above was disposed of as follows:');
		$sheet->getStyle('A'.$row.':I'.$row)->applyFromArray($sheetfont);

		$row=(int)$row+1;
		$sheet->setCellValue('B'.$row,'Item');
		$sheet->setCellValue('D'.$row,'Destroyed');
		if($lists[0]->is_destroyed==1){
			$sheet->setCellValue('C'.$row, 'R');
			$sheet->getStyle('C'.$row)->applyFromArray($forcheck);
		}
		$sheet->getStyle('B'.$row)->getAlignment()->setHorizontal('right');
		$sheet->getStyle('C'.$row)->getAlignment()->setHorizontal('center');
		$sheet->getStyle('C'.$row)->applyFromArray($borderBottomThin);

		$row=(int)$row+1;
		$sheet->setCellValue('B'.$row,'Item');
		$sheet->setCellValue('D'.$row,'Sold at private sale');
		if($lists[0]->private_sale==1){
			$sheet->setCellValue('C'.$row, 'R');
			$sheet->getStyle('C'.$row)->applyFromArray($forcheck);
		}
		$sheet->getStyle('B'.$row)->getAlignment()->setHorizontal('right');
		$sheet->getStyle('C'.$row)->getAlignment()->setHorizontal('center');
		$sheet->getStyle('C'.$row)->applyFromArray($borderBottomThin);
		$sheet->getStyle('B'.$row)->applyFromArray($sheetfont);
		$sheet->getStyle('D'.$row)->applyFromArray($sheetfont);

		$row=(int)$row+1;
		$sheet->setCellValue('B'.$row,'Item');
		$sheet->setCellValue('D'.$row,'Sold at public auction');
		if($lists[0]->public_auction==1){
			$sheet->setCellValue('C'.$row, 'R');
			$sheet->getStyle('C'.$row)->applyFromArray($forcheck);
		}
		$sheet->getStyle('B'.$row)->getAlignment()->setHorizontal('right');
		$sheet->getStyle('C'.$row)->getAlignment()->setHorizontal('center');
		$sheet->getStyle('C'.$row)->applyFromArray($borderBottomThin);
		$sheet->getStyle('B'.$row)->applyFromArray($sheetfont);
		$sheet->getStyle('D'.$row)->applyFromArray($sheetfont);

		$row=(int)$row+1;
		$sheet->setCellValue('B'.$row,'Item');//
		$sheet->setCellValue('D'.$row,'Transferred without cost to '.$lists[0]->agency_name);
		if($lists[0]->transferred==1){
			$sheet->setCellValue('C'.$row, 'R');
			$sheet->getStyle('C'.$row)->applyFromArray($forcheck);
		}
		$sheet->getStyle('B'.$row)->getAlignment()->setHorizontal('right');
		$sheet->getStyle('C'.$row)->getAlignment()->setHorizontal('center');
		$sheet->getStyle('C'.$row)->applyFromArray($borderBottomThin);
		$sheet->getStyle('B'.$row)->applyFromArray($sheetfont);
		$sheet->getStyle('D'.$row)->applyFromArray($sheetfont);

		$row=(int)$row+2;
		$rr=(int)$row;
		$sheet->setCellValue('A'.$row,'Certified Correct :');
		$sheet->setCellValue('F'.$row,'Witness to Disposal: ');
		$sheet->getStyle('A'.$row.':I'.$row)->applyFromArray($borderThin);
		$sheet->getStyle('B'.$row)->applyFromArray($sheetfont);
		$sheet->getStyle('D'.$row)->applyFromArray($sheetfont);

		$row=(int)$row+4;
		$sheet->setCellValue('B'.$row,strtoupper($lists[0]->inspection_officer));
		$sheet->setCellValue('G'.$row,strtoupper($lists[0]->witness));
		$sheet->mergeCells('B'.$row.':D'.$row);$sheet->mergeCells('G'.$row.':I'.$row);
		$sheet->getStyle('B'.$row.':I'.$row)->getAlignment()->setHorizontal('center');
		$sheet->getStyle('B'.$row.':D'.$row)->applyFromArray($signaturefont);
		$sheet->getStyle('G'.$row.':I'.$row)->applyFromArray($signaturefont);
		$sheet->getStyle('B'.$row.':D'.$row)->applyFromArray($borderBottomThin);
		$sheet->getStyle('G'.$row.':I'.$row)->applyFromArray($borderBottomThin);

		$row=(int)$row+1;
		$sheet->setCellValue('B'.$row,'Signature over Printed Name of Inspection Officer');
		$sheet->mergeCells('B'.$row.':D'.$row);
		$sheet->getStyle('B'.$row.':D'.$row)->getAlignment()->setWrapText(true);
		$sheet->setCellValue('G'.$row,'Signature over Printed Name of Witness');
		$sheet->mergeCells('G'.$row.':I'.$row);
		$sheet->getStyle('G'.$row.':I'.$row)->getAlignment()->setWrapText(true);
		$sheet->getRowDimension($row)->setRowHeight(30.60);
		$sheet->getStyle('B'.$row.':I'.$row)->getAlignment()->setHorizontal('center');
		$sheet->getStyle('G'.$row.':I'.$row)->getAlignment()->setVertical('top');
		

		$sheet->getStyle('A'.$rr.':E'.$row)->applyFromArray($borderThin);
		$sheet->getStyle('A'.$bstart.':I'.$row)->applyFromArray($borderMedium);
		$sheet->getStyle('A'.$rr.':I'.$row)->applyFromArray($sheetfont);

		$protect = Str::random(10);

		$sheet->getProtection()->setSheet(true);
		$sheet->getProtection()->setSort(true);
		$sheet->getProtection()->setInsertRows(true);
		$sheet->getProtection()->setFormatCells(true);

		$sheet->getProtection()->setPassword($protect);

			
		$writer = new Xlsx($spreadsheet);
		$writer->save('Waste Materials Report.xlsx');

		$filename="Waste Materials Report.xlsx";
		$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader("Xlsx");
		$spreadsheet = $reader->load("$filename");

		$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Mpdf');

		$pdf_path = 'Waste Materials Report.pdf';
		$writer->save($pdf_path);

			//return redirect('/'.$pdf_path);
		return redirect('/'.$filename);
 	}

 	public function disposal_report($id)
 	{
 		$lists = DB::table('disposals')
    					->join('disposal__details','disposals.id','disposal__details.d_id')
    					->where(['disposal__details.d_id'=>$id,'disposals.id'=>$id])
    					->get();

    	$headerfont = array(
	    	'font' 	=> array(
	        'bold'  => true,
	        'color' => array('rgb' => '000000'),
	        'size'  => 10,
	        'name'  => 'Cambria'
	    ));

	    $headerTitlefont = array(
	    	'font' 	=> array(
	        'bold'  => true,
	        'color' => array('rgb' => '000000'),
	        'size'  => 14,
	        'name'  => 'Cambria'
	    ));

	    $signaturefont = array(
	    	'font' 	=> array(
	        'bold'  => true,
	        'color' => array('rgb' => 'ffffff'),
	        'size'  => 11,
	        'name'  => 'Cambria'
	    ));

	    $agencyfont = array(
	    	'font' 	=> array(
	        'italic'  => true,
	        'color' => array('rgb' => '000000'),
	        'size'  => 11,
	        'name'  => 'Cambria'
	    ));

	    $unitfont = array(
	    	'font'  => array(
	        'color' => array('rgb' => '000000'),
	        'size'  => 11,
	        'name'  => 'Cambria'
	    ));

	    $sheetfont = array(
	    	'font'  => array(
	        'color' => array('rgb' => '000000'),
	        'name'  => 'Cambria'
	    ));

	    $entityfont = array(
	    	'font'  => array(
	        'color' => array('rgb' => '000000'),
	        'size'  => 11,
	        'name'  => 'Cambria'
	    ));




		$allCell = array(
		      'borders' => array(
		          'allBorders' => array(
		              'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
		              'color' => array('argb' => '000000'),
		          )
		      )
		  );

 		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();
		$sheet = $spreadsheet->getActiveSheet()->setTitle('DISPOSALS');

		$sheet->getColumnDimension('A')->setAutoSize(false);
		$sheet->getColumnDimension('A')->setWidth(5.33);
		$sheet->getColumnDimension('B')->setAutoSize(false);
		$sheet->getColumnDimension('B')->setWidth(43.11);
		$sheet->getColumnDimension('C')->setAutoSize(false);
		$sheet->getColumnDimension('C')->setWidth(30.00);

		$sheet->setCellValue('A1','MINDANAO DEVELOPMENT AUTHORITY');
		$sheet->setCellValue('A2',$lists[0]->cy_date. ' Disposal Plan');
		$sheet->setCellValue('A3',$lists[0]->item);
		$sheet->setCellValue('A5','#');$sheet->setCellValue('B5','Activity');$sheet->setCellValue('C5','Date');

		$row=5;
		$cnt=0;
		foreach ($lists as $i) {
			$row++;
			$cnt++;
			$sheet->setCellValue('A'.$row,$cnt);
			$sheet->setCellValue('B'.$row,$i->activity);
			$sheet->setCellValue('C'.$row,Carbon::parse($i->activity_date)->format('F j, Y'). ' - '.Carbon::parse($i->activity_date_end)->format('F j, Y'));
			$sheet->getStyle('B'.$row)->getAlignment()->setWrapText(true);
			$sheet->getStyle('A'.$row)->getAlignment()->setHorizontal('center');

		}

		$sheet->getStyle('A1')->applyFromArray($headerTitlefont);
		$sheet->getStyle('A2')->applyFromArray($headerfont);
		$sheet->getStyle('A5:C5')->getAlignment()->setHorizontal('center');
		$sheet->getStyle('A5:C5')->getAlignment()->setVertical('center');
		$sheet->getStyle('A5:C'.$row)->getAlignment()->setVertical('center');
		$sheet->getStyle('A5:C'.$row)->applyFromArray($allCell);
		$sheet->getStyle('A1:C'.$row)->applyFromArray($sheetfont);
		$sheet->getStyle('A5:C5')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('3b5998');
		$sheet->getRowDimension(5)->setRowHeight(22.80);
		$sheet->getStyle('A5:C5')->applyFromArray($signaturefont);

		$protect = Str::random(10);

		$sheet->getProtection()->setSheet(true);
		$sheet->getProtection()->setSort(true);
		$sheet->getProtection()->setInsertRows(true);
		$sheet->getProtection()->setFormatCells(true);

		$sheet->getProtection()->setPassword($protect);

 		$writer = new Xlsx($spreadsheet);
		$writer->save('Disposals Report.xlsx');

		$filename="Disposals Report.xlsx";
		return redirect('/'.$filename);

		$filename="Disposals Report.xlsx";
		$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader("Xlsx");
		$spreadsheet = $reader->load("$filename");

		$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Mpdf');

		$pdf_path = 'Disposals Report.pdf';
		$writer->save($pdf_path);

			//return redirect('/'.$pdf_path);
		return redirect('/'.$filename);
 	}

 	public function repairandmaintenance_report($id)
 	{
 		$lists = DB::table('repair_and__maintenances')
    					->where(['repair_and__maintenances.id'=>$id])
    					->get();

    	$headerfont = array(
	    	'font' 	=> array(
	        'bold'  => true,
	        'color' => array('rgb' => '000000'),
	        'size'  => 10,
	        'name'  => 'Cambria'
	    ));

	    $headerTitlefont = array(
	    	'font' 	=> array(
	        'bold'  => true,
	        'color' => array('rgb' => '000000'),
	        'size'  => 14,
	        'name'  => 'Cambria'
	    ));

	    $signaturefont = array(
	    	'font' 	=> array(
	        'bold'  => true,
	        'color' => array('rgb' => '000000'),
	        'size'  => 11,
	        'name'  => 'Cambria'
	    ));

	    $agencyfont = array(
	    	'font' 	=> array(
	        'italic'  => true,
	        'color' => array('rgb' => '000000'),
	        'size'  => 11,
	        'name'  => 'Cambria'
	    ));

	    $unitfont = array(
	    	'font'  => array(
	        'color' => array('rgb' => '000000'),
	        'size'  => 11,
	        'name'  => 'Cambria'
	    ));

	    $sheetfont = array(
	    	'font'  => array(
	        'color' => array('rgb' => '000000'),
	        'name'  => 'Cambria'
	    ));

	    $entityfont = array(
	    	'font'  => array(
	        'color' => array('rgb' => '000000'),
	        'size'  => 11,
	        'name'  => 'Cambria'
	    ));

	    $forcheck = array(
	    	'font'  	=> array(
	        'bold'  => true,
	        'color' => array('rgb' => '000000'),
	        'size'  => 12,
	        'name'  => 'Wingdings 2'
	    ));




		$allCell = array(
		      'borders' => array(
		          'allBorders' => array(
		              'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
		              'color' => array('argb' => '000000'),
		          )
		      )
		  );

		$borderThinDouble = array(
		    'borders' => array(
		        'outline' => array(
		            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_DOUBLE,
		            'color' => array('argb' => '000000'),
		        ),
		    ),
		);

		$borderThin = array(
		    'borders' => array(
		        'outline' => array(
		            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
		            'color' => array('argb' => '000000'),
		        ),
		    ),
		);

		$borderMedium = array(
		    'borders' => array(
		        'outline' => array(
		            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM,
		            'color' => array('argb' => '000000'),
		        ),
		    ),
		);

		$borderBottomDouble = array(
		    'borders' => array(
		        'bottom' => array(
		            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_DOUBLE,
		            'color' => array('argb' => '000000'),
		        ),
		    ),
		);

		$borderBottomThin = array(
		    'borders' => array(
		        'bottom' => array(
		            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
		            'color' => array('argb' => '000000'),
		        ),
		    ),
		);

    	$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();
		$sheet = $spreadsheet->getActiveSheet()->setTitle('REPAIR');

		$sheet->getColumnDimension('A')->setAutoSize(false);
		$sheet->getColumnDimension('A')->setWidth(4.33);
		$sheet->getColumnDimension('B')->setAutoSize(false);
		$sheet->getColumnDimension('B')->setWidth(15.00);
		$sheet->getColumnDimension('C')->setAutoSize(false);
		$sheet->getColumnDimension('C')->setWidth(33.33);
		$sheet->getColumnDimension('D')->setAutoSize(false);
		$sheet->getColumnDimension('D')->setWidth(9.89);
		$sheet->getColumnDimension('E')->setAutoSize(false);
		$sheet->getColumnDimension('E')->setWidth(19.67);

		$sheet->setCellValue('A1','Republic of the Philippines');
		$sheet->setCellValue('A2','MINDANAO DEVELOPMENT AUTHORITY');
		$sheet->setCellValue('A3','Regions IX, X, XI, XII, XII, CARAGA and ARMM');
		$sheet->setCellValue('A5','PRE-REPAIR');
		$sheet->setCellValue('B6','Item:');$sheet->setCellValue('C6',$lists[0]->item);
		$sheet->setCellValue('B7','ARE sticker:');$sheet->setCellValue('C7',$lists[0]->are_sticker);
		$sheet->setCellValue('B8','Findings:');$sheet->setCellValue('C8',$lists[0]->pre_findings);
		$sheet->setCellValue('A10','Recommendations:');$sheet->setCellValue('B11',$lists[0]->pre_recommendation);
		$sheet->setCellValue('D14','PRE-INSPECTED BY:');
		$sheet->setCellValue('E17',strtoupper($lists[0]->pre_inspector));
		$sheet->setCellValue('E18',Carbon::parse($lists[0]->pre_date_inspector)->format('n/j/Y'));
		$sheet->setCellValue('E19','Date');

		$sheet->setCellValue('A22','POST-REPAIR');
		$sheet->setCellValue('B23','Job Order No.:');
		$sheet->setCellValue('C23',$lists[0]->job_order);
		$sheet->setCellValue('B24','Date:');
		$sheet->setCellValue('C24',Carbon::parse($lists[0]->post_date_job)->format('n/j/Y'));
		$sheet->setCellValue('B25','Invoice No.:');
		$sheet->setCellValue('C25',$lists[0]->invoice);
		$sheet->setCellValue('B26','Date:');
		$sheet->setCellValue('C26',Carbon::parse($lists[0]->post_date_invoice)->format('n/j/Y'));

		$amount1=number_format($lists[0]->amount, 2, '.', ',');
		$payable=number_format($lists[0]->payable, 2, '.', ',');
		$desc = new \PhpOffice\PhpSpreadsheet\Helper\Html();
		$value = "<font face='Cambria'>Amount per Job Order <u><b> P  {$amount1} </b></u> Payable Amount &nbsp;&nbsp;&nbsp;&nbsp; <u><b> P {$payable} </b></u></font>";
		$cellValue = $desc->toRichTextObject($value);

		$sheet->setCellValue('B27',$cellValue);

		$sheet->setCellValue('A29','Findings:');
		$sheet->setCellValue('B30',$lists[0]->post_findings);

		$sheet->setCellValue('D36','INSPECTED BY:');
		$sheet->setCellValue('E39',strtoupper($lists[0]->post_inspector));

		$sheet->getStyle('A1')->applyFromArray($headerfont);
		$sheet->getStyle('A2')->applyFromArray($headerTitlefont);
		$sheet->getStyle('A3')->applyFromArray($agencyfont);
		$sheet->getStyle('A5:B10')->applyFromArray($signaturefont);
		$sheet->getStyle('A22:B26')->applyFromArray($signaturefont);
		$sheet->getStyle('A29')->applyFromArray($signaturefont);
		$sheet->getStyle('D14')->applyFromArray($signaturefont);
		$sheet->getStyle('E17')->applyFromArray($signaturefont);
		$sheet->getStyle('E19')->applyFromArray($agencyfont);
		$sheet->getStyle('E39')->applyFromArray($signaturefont);
		$sheet->getStyle('D36')->applyFromArray($signaturefont);
		$sheet->mergeCells('A1:E1');$sheet->mergeCells('A2:E2');$sheet->mergeCells('A3:E3');
		$sheet->mergeCells('B11:C12');$sheet->mergeCells('B30:C34');
		$sheet->getStyle('B27:E27')->getAlignment()->setWrapText(true);$sheet->mergeCells('B27:E27');
		$sheet->getStyle('B11:C12')->getAlignment()->setWrapText(true);
		$sheet->getStyle('B30:C34')->getAlignment()->setWrapText(true);

		$sheet->getStyle('A1:A3')->getAlignment()->setHorizontal('center');
		$sheet->getStyle('E17:E19')->getAlignment()->setHorizontal('center');
		$sheet->getStyle('B27:E27')->getAlignment()->setHorizontal('left');
		$sheet->getStyle('B27:E27')->getAlignment()->setVertical('top');
		$sheet->getStyle('E39')->getAlignment()->setHorizontal('center');
		$sheet->getStyle('E17')->applyFromArray($borderBottomThin);
		$sheet->getStyle('E18')->applyFromArray($borderBottomThin);
		$sheet->getStyle('E39')->applyFromArray($borderBottomThin);
		$sheet->getStyle('B11:C12')->getAlignment()->setHorizontal('left');
		$sheet->getStyle('B11:C12')->getAlignment()->setVertical('top');
		$sheet->getStyle('B30:C34')->getAlignment()->setHorizontal('left');
		$sheet->getStyle('B30:C34')->getAlignment()->setVertical('top');
		$sheet->getStyle('A1:E39')->applyFromArray($sheetfont);
		$sheet->getRowDimension('27')->setRowHeight(34.40);
		$sheet->getStyle('A1:E41')->applyFromArray($borderMedium);

		$protect = Str::random(10);

		$sheet->getProtection()->setSheet(true);
		$sheet->getProtection()->setSort(true);
		$sheet->getProtection()->setInsertRows(true);
		$sheet->getProtection()->setFormatCells(true);

		$sheet->getProtection()->setPassword($protect);

 		$writer = new Xlsx($spreadsheet);
		$writer->save('Repair and Maintenance Report.xlsx');

		$filename="Repair and Maintenance Report.xlsx";
		return redirect('/'.$filename);

		$filename="Repair and Maintenance Report.xlsx";
		$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader("Xlsx");
		$spreadsheet = $reader->load("$filename");

		$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Mpdf');

		$pdf_path = 'Repair and Maintenance Report.pdf';
		$writer->save($pdf_path);

			//return redirect('/'.$pdf_path);
		return redirect('/'.$filename);
 	}

 	public function rpci_report($id,$rpttype)
 	{

 		$data = DB::table('summaries')
    				->where(['summaries.type'=>'ris','summaries.date_receive'=>$id])
    				->select(DB::raw('summaries.ris_num as ris'),DB::raw('summaries.id as id'),DB::raw('summaries.respo_center as respocode'),DB::raw('summaries.stock_number as stock'), DB::raw('summaries.description as description'),DB::raw('summaries.stock_number as stock_number'),DB::raw('summaries.cluster as cluster'),DB::raw('summaries.unit as unit'), DB::raw('summaries.quantity as totalquantity'),DB::raw('sum(summaries.cost) as totalcost'),DB::raw('summaries.remarks as remarks'))
    				->groupBy(DB::raw('summaries.stock_number'))
    				->get();

    	$authsig = DB::table('sign_settings')
    				->get();


 		$headerfont = array(
	    	'font' 	=> array(
	        'bold'  => true,
	        'color' => array('rgb' => '000000'),
	        'size'  => 12,
	        'name'  => 'Cambria'
	    ));

	    $headerTitlefont = array(
	    	'font' 	=> array(
	        'bold'  => true,
	        'color' => array('rgb' => 'ffffff'),
	        'size'  => 11,
	        'name'  => 'Cambria'
	    ));

	    $signaturefont = array(
	    	'font' 	=> array(
	        'bold'  => true,
	        'color' => array('rgb' => '000000'),
	        'size'  => 11,
	        'name'  => 'Cambria'
	    ));

	    $agencyfont = array(
	    	'font' 	=> array(
	        'italic'  => true,
	        'color' => array('rgb' => '000000'),
	        'size'  => 11,
	        'name'  => 'Cambria'
	    ));

	    $unitfont = array(
	    	'font'  => array(
	        'color' => array('rgb' => '000000'),
	        'size'  => 11,
	        'name'  => 'Cambria'
	    ));

	    $sheetfont = array(
	    	'font'  => array(
	        'color' => array('rgb' => '000000'),
	        'size'  => 11,
	        'name'  => 'Cambria'
	    ));

	    $entityfont = array(
	    	'font'  => array(
	        'color' => array('rgb' => '000000'),
	        'size'  => 11,
	        'name'  => 'Cambria'
	    ));




		$allCell = array(
		      'borders' => array(
		          'allBorders' => array(
		              'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
		              'color' => array('argb' => '000000'),
		          )
		      )
		  );

		$borderThinDouble = array(
		    'borders' => array(
		        'outline' => array(
		            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_DOUBLE,
		            'color' => array('argb' => '000000'),
		        ),
		    ),
		);

		$borderThin = array(
		    'borders' => array(
		        'outline' => array(
		            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
		            'color' => array('argb' => '000000'),
		        ),
		    ),
		);

		$borderMedium = array(
		    'borders' => array(
		        'outline' => array(
		            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM,
		            'color' => array('argb' => '000000'),
		        ),
		    ),
		);

		$borderBottomDouble = array(
		    'borders' => array(
		        'bottom' => array(
		            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_DOUBLE,
		            'color' => array('argb' => '000000'),
		        ),
		    ),
		);

		$borderBottomThin = array(
		    'borders' => array(
		        'bottom' => array(
		            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
		            'color' => array('argb' => '000000'),
		        ),
		    ),
		);

    	$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();
		$sheet = $spreadsheet->getActiveSheet()->setTitle('RPCI');

		$sheet->getColumnDimension('A')->setAutoSize(false);
		$sheet->getColumnDimension('A')->setWidth(11.67);
		$sheet->getColumnDimension('B')->setAutoSize(false);
		$sheet->getColumnDimension('B')->setWidth(28.89);
		$sheet->getColumnDimension('C')->setAutoSize(false);
		$sheet->getColumnDimension('C')->setWidth(17.33);
		$sheet->getColumnDimension('D')->setAutoSize(false);
		$sheet->getColumnDimension('D')->setWidth(9.89);
		$sheet->getColumnDimension('E')->setAutoSize(false);
		$sheet->getColumnDimension('E')->setWidth(13.67);
		$sheet->getColumnDimension('F')->setAutoSize(false);
		$sheet->getColumnDimension('F')->setWidth(17.78);
		$sheet->getColumnDimension('G')->setAutoSize(false);
		$sheet->getColumnDimension('G')->setWidth(17.78);
		$sheet->getColumnDimension('H')->setAutoSize(false);
		$sheet->getColumnDimension('H')->setWidth(11.56);
		$sheet->getColumnDimension('I')->setAutoSize(false);
		$sheet->getColumnDimension('I')->setWidth(11.56);
		$sheet->getColumnDimension('J')->setAutoSize(false);
		$sheet->getColumnDimension('J')->setWidth(26.78);

		$sheet->setCellValue('A1','REPORT ON THE PHYSICAL COUNT OF INVENTORIES');
		$sheet->setCellValue('A2',$rpttype);
		$sheet->setCellValue('A3','As at '.Carbon::now()->format('j F Y'));
		$sheet->setCellValue('A5','Fund Cluster');$sheet->setCellValue('B5',$data[0]->cluster);

		$newDateFormat = \Carbon\Carbon::parse($authsig[0]->assume_date)->format('F Y');

		$personnel = new \PhpOffice\PhpSpreadsheet\Helper\Html();
		$value = "<font face='Cambria'>For which <u><b><b>{$authsig[0]->IARSupplyOfficer}, {$authsig[0]->IARSupplyOfficerPos}. MINDANAO DEVELOPMENT AUTHORITY</b></u>,<u><b></b></u>, <u><b></b></u> is accountable, having assumed such accountability on ( <u><b>$newDateFormat</b></u> ).</font>";
		$cellValue = $personnel->toRichTextObject($value);
	
		$sheet->getStyle('A1:A6')->applyFromArray($entityfont);
		$sheet->setCellValue('A6',$cellValue);

		$sheet->setCellValue('A8','Article');$sheet->setCellValue('B8','Description');$sheet->setCellValue('C8','Stock Number');
		$sheet->setCellValue('D8','Unit');$sheet->setCellValue('E8','Unit Value');$sheet->setCellValue('F8','Balance Per Card');
		$sheet->setCellValue('G8','On Hand Per Count');$sheet->setCellValue('H8','Shortage/Overage');$sheet->setCellValue('J8','Remarks');
		$sheet->setCellValue('F9','Quantity');$sheet->setCellValue('G9','Quantity');$sheet->setCellValue('H9','Quantity');
		$sheet->setCellValue('I9','Value');
		$sheet->mergeCells('A8:A9');$sheet->mergeCells('B8:B9');$sheet->mergeCells('C8:C9');$sheet->mergeCells('D8:D9');$sheet->mergeCells('E8:E9');
		$sheet->mergeCells('H8:I8');$sheet->mergeCells('J8:J9');
		$sheet->getStyle('A8:J9')->getAlignment()->setHorizontal('center');
		$sheet->getStyle('A8:J9')->getAlignment()->setVertical('center');
		$sheet->getStyle('A8:J9')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('3b5998');
		$sheet->getStyle('A1')->applyFromArray($headerfont);
		

		$row=9;
		foreach($data as $i)
		{
			$row++;
			//$sheet->setCellValue('A'.$row,$i->article);
			$sheet->setCellValue('B'.$row,nl2br(str_replace(" ", " &nbsp;", $i->description)));
			$sheet->setCellValue('C'.$row,$i->stock_number);
			$sheet->setCellValue('D'.$row,$i->unit);
			$sheet->setCellValue('E'.$row,number_format($i->totalcost, 2, '.', ','));
			
			$stockdata = DB::table('summaries')
                    ->where(['summaries.type'=>'iar','summaries.stock_number'=>$i->stock_number])
                    ->select(DB::raw('sum(summaries.quantity) as totalquantity'),DB::raw('summaries.id as id'), DB::raw('summaries.description as description'),DB::raw('sum(summaries.cost) as totalcost'),DB::raw('sum(summaries.available) as available'),DB::raw('summaries.physical_count as physical_count'))
                    ->groupBy(DB::raw('summaries.stock_number'))
                    ->get();

            $sheet->setCellValue('F'.$row,number_format($stockdata[0]->totalquantity, 0, '.', ','));

			$sheet->setCellValue('G'.$row,number_format($stockdata[0]->physical_count, 0, '.', ','));
			$sheet->setCellValue('H'.$row,number_format($stockdata[0]->totalquantity-$stockdata[0]->physical_count, 0, '.', ','));
			//$sheet->setCellValue('I'.$row,number_format($i->short_value, 2, '.', ','));
			$sheet->setCellValue('J'.$row,$i->remarks);
			$sheet->getStyle('C'.$row.':D'.$row)->getAlignment()->setHorizontal('center');
			$sheet->getStyle('E'.$row.':I'.$row)->getAlignment()->setHorizontal('right');
			$sheet->getStyle('A'.$row.':J'.$row)->applyFromArray($allCell);
		}

		$sheet->getStyle('A10:J'.$row)->getAlignment()->setWrapText(true);
		$srow=$row;
		$row=(int)$row+1;
		$sheet->setCellValue('A'.$row,'Certified Correct by:');
		$sheet->setCellValue('F'.$row,'Approved by:');
		$sheet->setCellValue('I'.$row,'Verified by:');

		$row=(int)$row+3;
		$sig=(int)$row+3;
		$sheet->setCellValue('B'.$row,$authsig[0]->RPCIInvCommitteeChair);
		$sheet->getStyle('B'.$row)->getAlignment()->setHorizontal('center');
		$sheet->setCellValue('C'.$row,$authsig[0]->RPCIInvCommitteeMember);
		$sheet->mergeCells('C'.$row.':D'.$row);
		$sheet->getStyle('C'.$row.':D'.$row)->getAlignment()->setHorizontal('center');
		$sheet->setCellValue('F'.$row,$authsig[0]->RPCIOICChair);
		$sheet->mergeCells('F'.$row.':H'.$row);
		$sheet->getStyle('F'.$row.':H'.$row)->getAlignment()->setHorizontal('center');
		$sheet->setCellValue('I'.$row,$authsig[0]->RPCICOARep);
		$sheet->mergeCells('I'.$row.':J'.$row);
		$sheet->getStyle('I'.$row.':J'.$row)->getAlignment()->setHorizontal('center');
		$sheet->getStyle('A'.$row.':J'.$row)->applyFromArray($signaturefont);
		$sheet->getStyle('B'.$row)->applyFromArray($borderBottomThin);
		$sheet->getStyle('C'.$row.':D'.$row)->applyFromArray($borderBottomThin);
		$sheet->getStyle('F'.$row.':H'.$row)->applyFromArray($borderBottomThin);
		$sheet->getStyle('I'.$row.':J'.$row)->applyFromArray($borderBottomThin);

		$row=(int)$row+1;
		$sheet->setCellValue('B'.$row,'Inventory Committee, Chair');
		$sheet->getStyle('B'.$row)->getAlignment()->setHorizontal('center');
		$sheet->setCellValue('C'.$row,'Inventory Committee, member');
		$sheet->setCellValue('F'.$row,'MinDA, OIC Chairman');
		$sheet->mergeCells('F'.$row.':H'.$row);
		$sheet->getStyle('F'.$row.':H'.$row)->getAlignment()->setHorizontal('center');
		$sheet->setCellValue('I'.$row,'COA Representative');
		$sheet->mergeCells('I'.$row.':J'.$row);
		$sheet->getStyle('I'.$row.':J'.$row)->getAlignment()->setHorizontal('center');
		$row=(int)$row+2;
		$sheet->setCellValue('A'.$row,'Witness:');

		$row=(int)$row+3;
		$sheet->setCellValue('B'.$row,$authsig[0]->RPCIFinDivRep);
		$sheet->getStyle('B'.$row)->applyFromArray($signaturefont);
		$sheet->getStyle('B'.$row)->applyFromArray($borderBottomThin);
		$sheet->getStyle('B'.$row)->getAlignment()->setHorizontal('center');


		$row=(int)$row+1;
		$sheet->setCellValue('B'.$row,'Finance Division Representative');
		$sheet->getStyle('B'.$row)->getAlignment()->setHorizontal('center');

		$sheet->getStyle('A1:J'.$row)->applyFromArray($sheetfont);
		$sheet->getStyle('A8:J9')->applyFromArray($headerTitlefont);
		$sheet->getStyle('A8:J9')->applyFromArray($allCell);
		$sheet->getStyle('A'.$srow.':J'.$row)->applyFromArray($borderThin);


		$protect = Str::random(10);

		$sheet->getProtection()->setSheet(true);
		$sheet->getProtection()->setSort(true);
		$sheet->getProtection()->setInsertRows(true);
		$sheet->getProtection()->setFormatCells(true);

		$sheet->getProtection()->setPassword($protect);

 		$writer = new Xlsx($spreadsheet);
		$writer->save('Report on the Physical Count of Inventories.xlsx');

		$filename="Report on the Physical Count of Inventories.xlsx";
		return redirect('/'.$filename);

		$filename="Report on the Physical Count of Inventories.xlsx";
		$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader("Xlsx");
		$spreadsheet = $reader->load("$filename");

		$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Mpdf');

		$pdf_path = 'Report on the Physical Count of Inventories.pdf';
		$writer->save($pdf_path);

			//return redirect('/'.$pdf_path);
		return redirect('/'.$filename);
 	}

 	public function reorder_report()
 	{
 		$data = DB::table('stock_libs')
                ->join('summaries','summaries.stock_number','stock_libs.stock_code')
                ->where(['summaries.type'=>'iar'])
                ->select(DB::raw('stock_libs.id as id'),DB::raw('stock_libs.stock_code as stock_code'),DB::raw('stock_libs.description as description'),DB::raw('stock_libs.unit as unit'),DB::raw('stock_libs.expense_category as expense_category'),DB::raw('stock_libs.reorderpoint as reorderpoint'),DB::raw('sum(summaries.available) as available'))
                ->groupBy('stock_libs.stock_code')
                ->get();


         $headerfont = array(
	    	'font' 	=> array(
	        'bold'  => true,
	        'color' => array('rgb' => '000000'),
	        'size'  => 12,
	        'name'  => 'Cambria'
	    ));

	    $headerTitlefont = array(
	    	'font' 	=> array(
	        'bold'  => true,
	        'color' => array('rgb' => '000000'),
	        'size'  => 11,
	        'name'  => 'Cambria'
	    ));

	    $signaturefont = array(
	    	'font' 	=> array(
	        'bold'  => true,
	        'color' => array('rgb' => '000000'),
	        'size'  => 11,
	        'name'  => 'Cambria'
	    ));

	    $agencyfont = array(
	    	'font' 	=> array(
	        'italic'  => true,
	        'color' => array('rgb' => '000000'),
	        'size'  => 11,
	        'name'  => 'Cambria'
	    ));

	    $unitfont = array(
	    	'font'  => array(
	        'color' => array('rgb' => '000000'),
	        'size'  => 11,
	        'name'  => 'Cambria'
	    ));

	    $sheetfont = array(
	    	'font'  => array(
	        'color' => array('rgb' => '000000'),
	        'size'  => 11,
	        'name'  => 'Cambria'
	    ));

	    $entityfont = array(
	    	'font'  => array(
	        'color' => array('rgb' => 'ffffff'),
	        'size'  => 11,
	        'bold'  => true,
	        'name'  => 'Cambria'
	    ));




		$allCell = array(
		      'borders' => array(
		          'allBorders' => array(
		              'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
		              'color' => array('argb' => '000000'),
		          )
		      )
		  );

		$borderThinDouble = array(
		    'borders' => array(
		        'outline' => array(
		            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_DOUBLE,
		            'color' => array('argb' => '000000'),
		        ),
		    ),
		);

		$borderThin = array(
		    'borders' => array(
		        'outline' => array(
		            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
		            'color' => array('argb' => '000000'),
		        ),
		    ),
		);

		$borderMedium = array(
		    'borders' => array(
		        'outline' => array(
		            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM,
		            'color' => array('argb' => '000000'),
		        ),
		    ),
		);

		$borderBottomDouble = array(
		    'borders' => array(
		        'bottom' => array(
		            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_DOUBLE,
		            'color' => array('argb' => '000000'),
		        ),
		    ),
		);

		$borderBottomThin = array(
		    'borders' => array(
		        'bottom' => array(
		            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
		            'color' => array('argb' => '000000'),
		        ),
		    ),
		);



        $spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();
		$sheet = $spreadsheet->getActiveSheet()->setTitle('RE-ORDER POINT');

		$sheet->getColumnDimension('A')->setAutoSize(false);
		$sheet->getColumnDimension('A')->setWidth(11.67);
		$sheet->getColumnDimension('B')->setAutoSize(false);
		$sheet->getColumnDimension('B')->setWidth(28.89);
		$sheet->getColumnDimension('C')->setAutoSize(false);
		$sheet->getColumnDimension('C')->setWidth(9.11);
		$sheet->getColumnDimension('D')->setAutoSize(false);
		$sheet->getColumnDimension('D')->setWidth(21.67);
		$sheet->getColumnDimension('E')->setAutoSize(false);
		$sheet->getColumnDimension('E')->setWidth(8.67);
		$sheet->getColumnDimension('F')->setAutoSize(false);
		$sheet->getColumnDimension('F')->setWidth(15.00);

		$sheet->setCellValue('A1','Republic of the Philippines');
		$sheet->setCellValue('A2','MINDANAO DEVELOPMENT AUTHORITY');
		$sheet->setCellValue('A4','LIST OF SUPPLIES NEED TO RE-ORDER');

		$sheet->mergeCells('A1:F1');
		$sheet->getStyle('A1:F1')->getAlignment()->setHorizontal('center');
		$sheet->mergeCells('A2:F2');
		$sheet->getStyle('A2:F2')->getAlignment()->setHorizontal('center');
		$sheet->mergeCells('A4:F4');
		$sheet->getStyle('A4:F4')->getAlignment()->setHorizontal('center');


		$sheet->setCellValue('A6','STOCK CODE');
		$sheet->setCellValue('B6','DESCRIPTION');
		$sheet->setCellValue('C6','UNIT');
		$sheet->setCellValue('D6','EXPENSE CATEGORY');
		$sheet->setCellValue('E6','RE-ORDER POINT');
		$sheet->setCellValue('F6','AVAILABLE');
		$sheet->getStyle('A6:F6')->getAlignment()->setHorizontal('center');
		$sheet->getStyle('A6:F6')->getAlignment()->setVertical('center');
		$sheet->getStyle('A6:F6')->getAlignment()->setWrapText(true);
		$sheet->getStyle('A6:F6')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('3b5998');

		$row=6;

		foreach ($data as $i) {
			if($i->available <= $i->reorderpoint)
			{
				$row++;
				$sheet->setCellValue('A'.$row,$i->stock_code);
				$sheet->setCellValue('B'.$row,$i->description);
				$sheet->setCellValue('C'.$row,$i->unit);
				$sheet->setCellValue('D'.$row,$i->expense_category);
				$sheet->setCellValue('E'.$row,number_format($i->reorderpoint, 0, '.', ','));
				$sheet->setCellValue('F'.$row,number_format($i->available, 0, '.', ','));
				$sheet->getStyle('D'.$row)->getAlignment()->setWrapText(true);
				$sheet->getStyle('A'.$row.':F'.$row)->getAlignment()->setVertical('center');
				$sheet->getStyle('E'.$row)->getAlignment()->setHorizontal('center');
				$sheet->getStyle('F'.$row)->getAlignment()->setHorizontal('center');
			}
		}


		$sheet->getStyle('A1:F1')->applyFromArray($headerTitlefont);
		$sheet->getStyle('A2:F4')->applyFromArray($headerfont);
		$sheet->getStyle('A6:F'.$row)->applyFromArray($allCell);
		$sheet->getStyle('A6:F6')->applyFromArray($entityfont);
		$sheet->getStyle('A7:F'.$row)->applyFromArray($sheetfont);

		$protect = Str::random(10);

		$sheet->getProtection()->setSheet(true);
		$sheet->getProtection()->setSort(true);
		$sheet->getProtection()->setInsertRows(true);
		$sheet->getProtection()->setFormatCells(true);

		$sheet->getProtection()->setPassword($protect);

 		$writer = new Xlsx($spreadsheet);
		$writer->save('List of Re-Order Supplies.xlsx');

		$filename="List of Re-Order Supplies.xlsx";
		return redirect('/'.$filename);

		$filename="List of Re-Order Supplies.xlsx";
		$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader("Xlsx");
		$spreadsheet = $reader->load("$filename");

		$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Mpdf');

		$pdf_path = 'List of Re-Order Supplies.pdf';
		$writer->save($pdf_path);

			//return redirect('/'.$pdf_path);
		return redirect('/'.$filename);
 	}

 	 public function library_list()
 	{

 		$data = DB::table('stock_libs')
 				->orderBy('stock_libs.id','desc')
                ->get();


         $headerfont = array(
	    	'font' 	=> array(
	        'bold'  => true,
	        'color' => array('rgb' => '000000'),
	        'size'  => 12,
	        'name'  => 'Cambria'
	    ));

	    $headerTitlefont = array(
	    	'font' 	=> array(
	        'bold'  => true,
	        'color' => array('rgb' => '000000'),
	        'size'  => 11,
	        'name'  => 'Cambria'
	    ));

	    $signaturefont = array(
	    	'font' 	=> array(
	        'bold'  => true,
	        'color' => array('rgb' => '000000'),
	        'size'  => 11,
	        'name'  => 'Cambria'
	    ));

	    $agencyfont = array(
	    	'font' 	=> array(
	        'italic'  => true,
	        'color' => array('rgb' => '000000'),
	        'size'  => 11,
	        'name'  => 'Cambria'
	    ));

	    $unitfont = array(
	    	'font'  => array(
	        'color' => array('rgb' => '000000'),
	        'size'  => 11,
	        'name'  => 'Cambria'
	    ));

	    $sheetfont = array(
	    	'font'  => array(
	        'color' => array('rgb' => '000000'),
	        'size'  => 11,
	        'name'  => 'Cambria'
	    ));

	    $entityfont = array(
	    	'font'  => array(
	        'color' => array('rgb' => 'ffffff'),
	        'size'  => 11,
	        'bold'  => true,
	        'name'  => 'Cambria'
	    ));




		$allCell = array(
		      'borders' => array(
		          'allBorders' => array(
		              'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
		              'color' => array('argb' => '000000'),
		          )
		      )
		  );

		$borderThinDouble = array(
		    'borders' => array(
		        'outline' => array(
		            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_DOUBLE,
		            'color' => array('argb' => '000000'),
		        ),
		    ),
		);

		$borderThin = array(
		    'borders' => array(
		        'outline' => array(
		            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
		            'color' => array('argb' => '000000'),
		        ),
		    ),
		);

		$borderMedium = array(
		    'borders' => array(
		        'outline' => array(
		            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM,
		            'color' => array('argb' => '000000'),
		        ),
		    ),
		);

		$borderBottomDouble = array(
		    'borders' => array(
		        'bottom' => array(
		            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_DOUBLE,
		            'color' => array('argb' => '000000'),
		        ),
		    ),
		);

		$borderBottomThin = array(
		    'borders' => array(
		        'bottom' => array(
		            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
		            'color' => array('argb' => '000000'),
		        ),
		    ),
		);



        $spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();
		$sheet = $spreadsheet->getActiveSheet()->setTitle('STOCK LISTS LIBRARY');

		$sheet->getColumnDimension('A')->setAutoSize(false);
		$sheet->getColumnDimension('A')->setWidth(11.67);
		$sheet->getColumnDimension('B')->setAutoSize(false);
		$sheet->getColumnDimension('B')->setWidth(31.44);
		$sheet->getColumnDimension('C')->setAutoSize(false);
		$sheet->getColumnDimension('C')->setWidth(9.11);
		$sheet->getColumnDimension('D')->setAutoSize(false);
		$sheet->getColumnDimension('D')->setWidth(31.44);
		$sheet->getColumnDimension('E')->setAutoSize(false);
		$sheet->getColumnDimension('E')->setWidth(13.22);

		$sheet->setCellValue('A1','Republic of the Philippines');
		$sheet->setCellValue('A2','MINDANAO DEVELOPMENT AUTHORITY');
		$sheet->setCellValue('A4','STOCK LISTS LIBRARY');

		$sheet->mergeCells('A1:E1');
		$sheet->getStyle('A1:E1')->getAlignment()->setHorizontal('center');
		$sheet->mergeCells('A2:E2');
		$sheet->getStyle('A2:E2')->getAlignment()->setHorizontal('center');
		$sheet->mergeCells('A4:E4');
		$sheet->getStyle('A4:E4')->getAlignment()->setHorizontal('center');


		$sheet->setCellValue('A6','STOCK CODE');
		$sheet->setCellValue('B6','DESCRIPTION');
		$sheet->setCellValue('C6','UNIT');
		$sheet->setCellValue('D6','EXPENSE CATEGORY');
		$sheet->setCellValue('E6','RE-ORDER POINT');
		$sheet->getStyle('A6:E6')->getAlignment()->setHorizontal('center');
		$sheet->getStyle('A6:E6')->getAlignment()->setVertical('center');
		$sheet->getStyle('A6:E6')->getAlignment()->setWrapText(true);
		$sheet->getStyle('A6:E6')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('3b5998');

		$row=6;

		foreach ($data as $i) {
				$row++;
				$sheet->setCellValue('A'.$row,$i->stock_code);
				$sheet->setCellValue('B'.$row,$i->description);
				$sheet->setCellValue('C'.$row,$i->unit);
				$sheet->setCellValue('D'.$row,$i->expense_category);
				$sheet->setCellValue('E'.$row,number_format($i->reorderpoint, 0, '.', ','));
				$sheet->getStyle('D'.$row)->getAlignment()->setWrapText(true);
				$sheet->getStyle('A'.$row.':F'.$row)->getAlignment()->setVertical('center');
				$sheet->getStyle('E'.$row)->getAlignment()->setHorizontal('center');
			
		}


		$sheet->getStyle('A1:E1')->applyFromArray($headerTitlefont);
		$sheet->getStyle('A2:E4')->applyFromArray($headerfont);
		$sheet->getStyle('A6:E'.$row)->applyFromArray($allCell);
		$sheet->getStyle('A6:E6')->applyFromArray($entityfont);
		$sheet->getStyle('A7:E'.$row)->applyFromArray($sheetfont);

		$protect = Str::random(10);

		$sheet->getProtection()->setSheet(true);
		$sheet->getProtection()->setSort(true);
		$sheet->getProtection()->setInsertRows(true);
		$sheet->getProtection()->setFormatCells(true);

		$sheet->getProtection()->setPassword($protect);

 		$writer = new Xlsx($spreadsheet);
		$writer->save('List of Stocks Library.xlsx');

		$filename="List of Stocks Library.xlsx";
		return redirect('/'.$filename);

		$filename="List of Stocks Library.xlsx";
		$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader("Xlsx");
		$spreadsheet = $reader->load("$filename");

		$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Mpdf');

		$pdf_path = 'List of Stocks Library.pdf';
		$writer->save($pdf_path);

			//return redirect('/'.$pdf_path);
		return redirect('/'.$filename);

 	}
}
