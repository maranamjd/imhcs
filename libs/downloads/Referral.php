<?php
  /**
   *
   */
  class ReferralFile
  {

    function __construct()
    {
      // echo json_encode($data);
      // die;
      date_default_timezone_set('Asia/Manila');
      $this->patient_name = '';
      $this->date = date('F d, Y');
      $this->age = '';
      $this->sex = '';
      $this->bday = '';
      $this->address = '';
      $this->physician = '';
      $this->personnel = '';
      $this->findings = '';
      $this->diagnosis = '';
      $this->recommendations = '';
      $this->data = [];
      $this->pdf = new FPDF('P');
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
      $this->pdf->Rect(10, 10, 195, 27, 'D');
      $this->pdf->Rect(11, 11, 193, 25, 'D');
      $this->pdf->SetTextColor(0,0,0);
    }

    private function _createInfo(){
      $this->pdf->SetFont('Calibri','',12);
      $this->pdf->SetXY(15,50);
      $this->pdf->Cell(0,6,"PATIENT'S INFORMATION",0,1,'L',false);
      $this->pdf->SetXY(160,50);
      $this->pdf->Cell(0,6,"Report prepared by:",0,1,'L',false);
      $this->pdf->SetXY(150,58);
      $this->pdf->Cell(0,6,$this->personnel,0,1,'C',false);
      $this->pdf->setXY(15,62);
      $this->pdf->Cell(0,6,"NAME: ",0,1,'L',false);
      $this->pdf->setXY(30,62);
      $this->pdf->Cell(100,6,$this->patient_name,'B',1,'C',false);
      $this->pdf->setXY(15,68);
      $this->pdf->Cell(40,6,"AGE: ",0,0,'L',false);
      $this->pdf->setXY(25,68);
      $this->pdf->Cell(25,5,$this->age,'B',0,'C',false);
      $this->pdf->setXY(52,68);
      $this->pdf->Cell(25,6,"SEX: ",0,0,'L',false);
      $this->pdf->setXY(60,68);
      $this->pdf->Cell(16,5,$this->sex,'B',0,'C',false);
      $this->pdf->setXY(78,68);
      $this->pdf->Cell(30,6,"BDAY: ",0,0,'L',false);
      $this->pdf->setXY(90,68);
      $this->pdf->Cell(35,5,$this->bday,'B',1,'C',false);
      $this->pdf->setXY(150,68);
      $this->pdf->Cell(30,6,"DATE: ",0,0,'L',false);
      $this->pdf->setXY(162,68);
      $this->pdf->Cell(35,5,$this->date,'B',1,'C',false);
      $this->pdf->Rect(10, 48, 195, 28, 'D');
      $this->pdf->Rect(11, 49, 193, 26, 'D');


      $this->pdf->SetXY(15,85);
      $this->pdf->Cell(0,6,"PHYSICIAN'S INFORMATION",0,1,'L',false);
      $this->pdf->SetFont('Calibri Bold','B',20);
      $this->pdf->SetXY(115,85);
      $this->pdf->Cell(0,6,"REFERRAL FOR TRANSFER",0,1,'L',false);
      $this->pdf->SetFont('Calibri','',12);
      $this->pdf->setXY(15,97);
      $this->pdf->Cell(0,6,"NAME: ",0,1,'L',false);
      $this->pdf->setXY(30,97);
      $this->pdf->Cell(100,6,$this->physician,'B',1,'C',false);
      $this->pdf->setXY(15,105);
      $this->pdf->Cell(40,6,"ADDRESS: ",0,0,'L',false);
      $this->pdf->setXY(35,105);
      $this->pdf->Cell(95,5,$this->address,'B',0,'C',false);
      $this->pdf->Rect(10, 83, 195, 30, 'D');
      $this->pdf->Rect(11, 84, 193, 28, 'D');

    }

    private function _createBody(){
      $this->pdf->SetXY(15,121);
      $this->pdf->MultiCell(190,4,'Dear Doctor: The above patient has been evaluated in our office. During our case history and examination, we became aware of a problem which we felt requires medical attention. We are sending the patient to you for further investigation and care.',0,'L',false);
      $this->pdf->SetXY(40,135);
      $this->pdf->Cell(90,4,'It would be appreciated if you could contact us and inform us of your conclusion.',0,1,'C',false);
      $this->pdf->SetXY(15,141);
      $this->pdf->Cell(95,4,'Thank you.',0,0,'L',false);
      $this->pdf->Rect(10, 118, 195, 30, 'D');
      $this->pdf->Rect(11, 119, 193, 28, 'D');


      $this->pdf->SetXY(15,156);
      $this->pdf->Cell(0,6,"FINDINGS:",0,1,'L',false);
      $this->pdf->SetXY(25,170);
      $this->pdf->MultiCell(190,4,$this->findings,0,'L',false);
      $this->pdf->SetXY(15,196);
      $this->pdf->Cell(0,6,"PRELIMINARY DIAGNOSIS:",0,1,'L',false);
      $this->pdf->SetXY(25,210);
      $this->pdf->MultiCell(190,4,$this->diagnosis,0,'L',false);
      $this->pdf->Rect(10, 153, 195, 75, 'D');
      $this->pdf->Rect(11, 154, 193, 73, 'D');


      $this->pdf->SetXY(15,237);
      $this->pdf->Cell(0,6,"RECOMMENDATIONS AND REQUESTS:",0,1,'L',false);
      $this->pdf->SetXY(25,247);
      $this->pdf->MultiCell(190,4,$this->recommendations,0,'L',false);
      $this->pdf->Rect(10, 234, 195, 30, 'D');
      $this->pdf->Rect(11, 235, 193, 28, 'D');
    }

    private function _createFooter(){
      $this->pdf->SetXY(15,270);
      $this->pdf->Cell(0,6,"SIGNED:",0,1,'L',false);
      $this->pdf->Rect(10, 267, 195, 20, 'D');
      $this->pdf->Rect(11, 268, 193, 18, 'D');
    }


    public function generate(){
      $this->_initpdf();
      $this->_createHeader();
      $this->_createInfo();
      $this->_createBody();
      $this->_createFooter();
      $this->pdf->output('I', $this->patient_name."-Referral ".date('Y-m-d').".pdf");
    }

  }
