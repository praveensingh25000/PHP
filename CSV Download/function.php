<?php
$data[0] = array('Email','Firstname','Lastname','Phone');
$data[1] = array('pks@gmail.com','Praveen','Singh','7307396983');
$data[2] = array('Pankaj@gmail.com','Pankaj','Thakur','7894582143');

$header[]   = 'Infin Employee Doc';
$footer[]   = 'Company:infin technology';
$filename   = 'pksdoc-'.date('d-m-Y-A');;
$date[]     = date('d-m-Y-A');

downloadCSV($data, $header, $footer,$filename);

function downloadCSV($data, $header, $footer,$filename){

		//echo '<pre>';print_r($data);echo '</pre>';

		header('Content-Type: text/csv; charset=utf-8');
		header('Content-Disposition: attachment; filename='.$filename.'.csv');

		// create a file pointer connected to the output stream
		$output = fopen('php://output', 'w');		

		fputcsv($output, $header); //output the Title

		fputcsv($output, array('id'=>'')); //output line break

		if(!empty($data)){

			$headerColumns = $data[0];

			fputcsv($output, $headerColumns); //output the Title 

			$data_out = array_slice($data,1);
			foreach($data_out as $resultkey => $resultTD){
				$rows = array();
				foreach($resultTD as $tdkey => $resultTDvalue){
					$rows[] = $resultTDvalue;
				}
				fputcsv($output, $rows);
			}
		}		

		fputcsv($output, array('id'=>'')); //output line break

		fputcsv($output, $footer); //output the Footer

}
?>