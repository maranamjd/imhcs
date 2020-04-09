<?php
  /**
   *
   */
  class FitnessCertificateFile
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
      $this->pdf->Cell(55,4,'MEDICAL FITNESS CERTIFICATE',0,0,'C',false);

      //data
      $this->pdf->SetFont('Calibri','',18);
      $this->pdf->setXY(215,65);
      $this->pdf->Cell(55,5,$this->date,'B',0,'C',false);
      $this->pdf->setXY(45,90);
      $this->pdf->Cell(90,5,$this->personnel,'B',0,'C',false);
      $this->pdf->setXY(35,98);
      $this->pdf->Cell(230,5,$this->patient_name,'B',0,'C',false);


      //texts
      $this->pdf->SetFont('Calibri','',14);
      $this->pdf->setXY(35,90);
      $this->pdf->Cell(55,4,'I Dr. ',0,0,'L',false);
      $this->pdf->setXY(138,90);
      $this->pdf->Cell(55,4,'certify that I have carefuly examined Mr./Ms.',0,0,'L',false);
      $this->pdf->setXY(35,108);
      $this->pdf->Cell(55,4,'whose signature is given below.',0,0,'L',false);
      $this->pdf->SetXY(35,118);
      $this->pdf->MultiCell(230,8,'Based on the examination, I certify that he/she is in a good mental and physical health and is free from any physical defects which may interfere with his/her professional work including the active outdoor duties required for a professional purpose.',0,'L',false);
      $this->pdf->setXY(35,158);
      $this->pdf->Cell(55,4,'Sincerely,',0,0,'L',false);

      //labels
      // $this->pdf->setXY(215,71);
      // $this->pdf->Cell(55,4,'(Date)',0,0,'C',false);
      // $this->pdf->setXY(110,96);
      // $this->pdf->Cell(55,4,'(Name of Patient)',0,0,'C',false);
      // $this->pdf->setXY(199,96);
      // $this->pdf->Cell(55,4,'(Address)',0,0,'C',false);
      // $this->pdf->setXY(178,114);
      // $this->pdf->Cell(55,4,'(Date)',0,0,'C',false);
      // $this->pdf->setXY(114,164);
      // $this->pdf->Cell(55,4,'(Attending Physician)',0,0,'C',false);


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
      $this->pdf->output('I', $this->patient_name."-Fitness Certificate ".date('Y-m-d').".pdf");
    }

  }
