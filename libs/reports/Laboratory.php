<?php
  /**
   *
   */
  class LaboratoryReportFile extends Helper
  {

    function __construct()
    {
      // echo json_encode($data);
      // die;
      date_default_timezone_set('Asia/Manila');
      $this->date = date('F d, Y');
      $this->personnel = '';
      $this->data = [];
      $this->pdf = new FPDF('L');
    }

    private function _initpdf(){
      $this->pdf->AddFont('Calibri','','Calibri.php');
      $this->pdf->AddFont('BodoniMTBlack','B','BodoniMTBlack.php');
      $this->pdf->AddFont('Calibri Bold','B','Calibri Bold.php');
      $this->pdf->SetMargins(5, 0, 0);
    }

    private function _createHeader(){
      $this->pdf->AddPage();
      $this->pdf->setY(15);
      $this->pdf->SetFont('Calibri','',26);
      $this->pdf->Cell(0,6,'Isidro Mendoza Health Center',0,1,'C',false);
      $this->pdf->SetFont('Calibri','',12);
      $this->pdf->SetTextColor(92,92,92);
      $this->pdf->Cell(0,6,'2158 Jesus St, Pandacan, Manila, 1000 Metro Manila',0,1,'C',false);
      $this->pdf->Cell(0,4,'(02) 8563 3273',0,1,'C',false);
      $this->pdf->SetTextColor(0,0,0);
    }


    private function _createBody(){
      $this->pdf->SetFont('Calibri Bold','B',14);
      $this->pdf->setXY(125,40);
      $this->pdf->Cell(55,4,'Laboratory Tests',0,0,'C',false);

      //data
      $this->pdf->setXY(5,55);
      $this->pdf->Cell(5,5,'#',1,0,'C',false);
      $this->pdf->Cell(45,5,'Patient\'s Name',1,0,'C',false);
      $this->pdf->Cell(40,5,'Laboratory Test',1,0,'C',false);
      $this->pdf->Cell(50,5,'Requested By',1,0,'C',false);
      $this->pdf->Cell(30,5,'Request Date',1,0,'C',false);
      $this->pdf->Cell(30,5,'Date Fulfilled',1,0,'C',false);
      $this->pdf->Cell(50,5,'Result',1,0,'C',false);
      $this->pdf->Cell(40,5,'Note',1,1,'C',false);

      $this->pdf->SetFont('Calibri','',12);
      foreach ($this->data as $key => $record) {
        $this->pdf->setX(5);
        $this->pdf->Cell(5,5,++$key,1,0,'C',false);
        $this->pdf->Cell(45,5,$record['patient'],1,0,'C',false);
        $this->pdf->Cell(40,5,$record['description'],1,0,'C',false);
        $this->pdf->Cell(50,5,$record['requested_by'],1,0,'C',false);
        $this->pdf->Cell(30,5,date('M d, Y', strtotime($record['date_requested'])),1,0,'C',false);
        $this->pdf->Cell(30,5,$record['date_updated'] == '' ? '' : date('M d, Y', strtotime($record['date_updated'])),1,0,'C',false);
        $this->pdf->Cell(50,5,$record['results'],1,0,'C',false);
        $this->pdf->Cell(40,5,$record['note'],1,1,'C',false);
      }
    }

    private function _createFooter(){
      $this->pdf->SetAutoPageBreak(true,1);
      $this->pdf->SetFont('Calibri','',11);
      $this->pdf->setXY(35,185);
      $this->pdf->Cell(55,4,$this->count($this->data),'B',0,'C',false);
      $this->pdf->setXY(35,190);
      $this->pdf->SetFont('Calibri','',10);
      $this->pdf->Cell(55,4,'No. of records',0,0,'C',false);

      $this->pdf->setXY(120,185);
      $this->pdf->Cell(55,4,$this->date,'B',0,'C',false);
      $this->pdf->setXY(120,190);
      $this->pdf->SetFont('Calibri','',10);
      $this->pdf->Cell(55,4,'Date',0,0,'C',false);

      $this->pdf->setXY(215,185);
      $this->pdf->Cell(55,4,$this->personnel,'B',0,'C',false);
      $this->pdf->setXY(215,190);
      $this->pdf->SetFont('Calibri','',10);
      $this->pdf->Cell(55,4,'Generated By',0,0,'C',false);
    }


    public function generate(){
      $this->_initpdf();
      $this->_createHeader();
      $this->_createBody();
      $this->_createFooter();
      $this->pdf->output('I', "Laboratory Report - ".date('Y-m-d').".pdf");
    }

  }
