<?php
  /**
   *
   */
  class MedicalCertificateFile
  {

    function __construct()
    {
      // echo json_encode($data);
      // die;
      date_default_timezone_set('Asia/Manila');
      $this->patient_name = '';
      $this->date = date('F d, Y');
      $this->address = '';
      $this->checkup_date = '';
      $this->personnel = '';
      $this->diagnosis = '';
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
      $this->pdf->SetFont('Calibri Bold','B',34);
      $this->pdf->setXY(125,50);
      $this->pdf->Cell(55,4,'MEDICAL CERTIFICATE',0,0,'C',false);

      //data
      $this->pdf->SetFont('Calibri','',16);
      $this->pdf->setXY(215,65);
      $this->pdf->Cell(55,5,$this->date,'B',0,'C',false);
      $this->pdf->setXY(102,90);
      $this->pdf->Cell(70,5,$this->patient_name,'B',0,'C',false);
      $this->pdf->setXY(182,90);
      $this->pdf->Cell(88,5,$this->address,'B',0,'C',false);
      $this->pdf->setXY(155,108);
      $this->pdf->Cell(100,5,$this->checkup_date,'B',0,'C',false);
      $this->pdf->SetXY(25,128);
      $this->pdf->MultiCell(245,5,$this->diagnosis,'B','C',false);
      $this->pdf->setXY(105,158);
      $this->pdf->Cell(70,5,$this->personnel,'B',0,'C',false);


      //texts
      $this->pdf->SetFont('Calibri Bold','B',14);
      $this->pdf->setXY(25,75);
      $this->pdf->Cell(55,4,'To Whom It May Concern:',0,0,'C',false);
      $this->pdf->SetFont('Calibri','',14);
      $this->pdf->setXY(50,90);
      $this->pdf->Cell(55,4,'THIS IS TO CERTIFY that',0,0,'C',false);
      $this->pdf->setXY(148,90);
      $this->pdf->Cell(55,4,'of',0,0,'C',false);
      $this->pdf->setXY(25,108);
      $this->pdf->Cell(55,4,'Was examined and treated at Isidro Mendoza Health Center on',0,0,'L',false);
      $this->pdf->setXY(25,118);
      $this->pdf->Cell(55,4,'with the following diagnosis:',0,0,'L',false);
      $this->pdf->setXY(25,158);
      $this->pdf->Cell(55,4,'And would need medical attention for',0,0,'L',false);
      $this->pdf->setXY(176,158);
      $this->pdf->Cell(55,4,'days barring complication.',0,0,'L',false);

      //labels
      $this->pdf->setXY(215,71);
      $this->pdf->Cell(55,4,'(Date)',0,0,'C',false);
      $this->pdf->setXY(110,96);
      $this->pdf->Cell(55,4,'(Name of Patient)',0,0,'C',false);
      $this->pdf->setXY(199,96);
      $this->pdf->Cell(55,4,'(Address)',0,0,'C',false);
      $this->pdf->setXY(178,114);
      $this->pdf->Cell(55,4,'(Date)',0,0,'C',false);
      $this->pdf->setXY(114,164);
      $this->pdf->Cell(55,4,'(Attending Physician)',0,0,'C',false);


    }

    private function _createFooter(){
      $this->pdf->SetAutoPageBreak(true,1);
      $this->pdf->SetFont('Calibri','',11);
      $this->pdf->setXY(215,185);
      $this->pdf->Cell(55,4,$this->personnel,'B',0,'C',false);
      $this->pdf->setXY(215,190);
      $this->pdf->SetFont('Calibri','',10);
      $this->pdf->Cell(55,4,'(Attending Physician)',0,0,'C',false);
    }


    public function generate(){
      $this->_initpdf();
      $this->_createHeader();
      $this->_createBody();
      $this->_createFooter();
      $this->pdf->output('I', $this->patient_name."-Medical Certificate ".date('Y-m-d').".pdf");
    }

  }
