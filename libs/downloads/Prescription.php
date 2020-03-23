<?php
  /**
   *
   */
  class PrescriptionFile
  {

    function __construct()
    {
      // echo json_encode($data);
      // die;
      date_default_timezone_set('Asia/Manila');
      $this->patient_name = '';
      $this->date = date('F d, Y');
      $this->address = '';
      $this->age = '';
      $this->sex = '';
      $this->personnel = '';
      $this->note = '';
      $this->data = [];
      $this->pdf = new FPDF('P', 'mm', array(102, 140));
    }

    private function _initpdf(){
      $this->pdf->AddFont('Calibri','','Calibri.php');
      $this->pdf->AddFont('BodoniMTBlack','B','BodoniMTBlack.php');
      $this->pdf->AddFont('Calibri Bold','B','Calibri Bold.php');
      $this->pdf->SetMargins(5, 0, 0);
    }

    private function _createHeader(){
      $this->pdf->AddPage();
      $this->pdf->setY(5);
      $this->pdf->SetFont('Calibri','',19);
      $this->pdf->Cell(0,6,'Isidro Mendoza Health Center',0,1,'C',false);
      $this->pdf->SetFont('Calibri','',9);
      $this->pdf->SetTextColor(92,92,92);
      $this->pdf->Cell(0,4,'2158 Jesus St, Pandacan, Manila, 1000 Metro Manila',0,1,'C',false);
      $this->pdf->Cell(0,4,'(02) 8563 3273',0,1,'C',false);
      $this->pdf->Cell(93,4,'','B',1,'C',false);
      $this->pdf->SetTextColor(0,0,0);
    }

    private function _createInfo(){
      $this->pdf->SetXY(5,25);
      $this->pdf->SetFont('Calibri','',11);
      $this->pdf->Cell(0,5,"Patient's name: ",0,1,'L',false);
      $this->pdf->setXY(32,25);
      $this->pdf->Cell(66,5,$this->patient_name,'B',1,'C',false);
      $this->pdf->Cell(0,5,"Address: ",0,1,'L',false);
      $this->pdf->SetFont('Calibri','',10);
      $this->pdf->setXY(21,30);
      $this->pdf->Cell(77,5,$this->address,'B',1,'C',false);
      $this->pdf->Cell(40,5,"Age: ",0,0,'L',false);
      $this->pdf->setXY(14,35);
      $this->pdf->Cell(25,5,$this->age,'B',0,'C',false);
      $this->pdf->Cell(25,5,"Sex: ",0,0,'L',false);
      $this->pdf->setXY(48,35);
      $this->pdf->Cell(16,5,$this->sex,'B',0,'C',false);
      $this->pdf->Cell(30,5,"Date: ",0,0,'L',false);
      $this->pdf->setXY(75,35);
      $this->pdf->Cell(23,5,$this->date,'B',1,'C',false);
    }

    private function _createBody(){
      $this->pdf->SetFont('Calibri','',11);
      $this->pdf->setXY(1,55);
      $this->pdf->Cell(4,4,'#',1,0,'C',false);
      $this->pdf->Cell(33,4,'Medicine',1,0,'C',false);
      $this->pdf->Cell(20,4,'No. of Days',1,0,'C',false);
      $this->pdf->Cell(20,4,'Schedule',1,0,'C',false);
      $this->pdf->Cell(23,4,'Before meal?',1,1,'C',false);
      foreach ($this->data as $key => $prescription) {
        $this->pdf->setX(1);
        $this->pdf->Cell(4,4,++$key,1,0,'C',false);
        $this->pdf->Cell(33,4,$prescription['name'],1,0,'C',false);
        $this->pdf->Cell(20,4,$prescription['no_days'],1,0,'C',false);
        $this->pdf->Cell(20,4,$prescription['intake_schedule'],1,0,'C',false);
        $this->pdf->Cell(23,4,$prescription['before_meal'] == 1 ? 'Yes' : 'No',1,1,'C',false);
      }
    }

    private function _createFooter(){
      $this->pdf->SetAutoPageBreak(true,1);
      $this->pdf->Image("public/img/rx.png", 7, 105, 30);
      $this->pdf->SetFont('Calibri','',11);
      $this->pdf->setXY(45,120);
      $this->pdf->Cell(55,4,$this->personnel,'B',0,'C',false);
      $this->pdf->setXY(45,125);
      $this->pdf->SetFont('Calibri','',10);
      $this->pdf->Cell(55,4,'Signature',0,0,'C',false);
    }


    public function generate(){
      $this->_initpdf();
      $this->_createHeader();
      $this->_createInfo();
      $this->_createBody();
      $this->_createFooter();
      $this->pdf->output('I', $this->patient_name."-prescription ".date('Y-m-d').".pdf");
    }

  }
