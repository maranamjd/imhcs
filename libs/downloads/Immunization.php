<?php
  /**
   *
   */
  class ImmunizationFile
  {

    function __construct()
    {
      // echo json_encode($data);
      // die;
      date_default_timezone_set('Asia/Manila');
      $this->child_name = '';
      $this->mother_name = '';
      $this->father_name = '';
      $this->date = date('F d, Y');
      $this->address = '';
      $this->age = '';
      $this->sex = '';
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
      $this->pdf->Cell(288,4,'','B',1,'C',false);
      $this->pdf->SetTextColor(0,0,0);
    }

    private function _createInfo(){
      $this->pdf->SetFont('Calibri','',12);
      $this->pdf->SetXY(35,50);
      $this->pdf->Cell(0,6,"Child's name: ",0,1,'L',false);
      $this->pdf->setXY(62,49);
      $this->pdf->Cell(69,6,$this->child_name,'B',1,'C',false);

      $this->pdf->setXY(35,56);
      $this->pdf->Cell(0,6,"Mother's name: ",0,1,'L',false);
      $this->pdf->setXY(65,55);
      $this->pdf->Cell(66,6,$this->mother_name,'B',1,'C',false);

      $this->pdf->setXY(35,62);
      $this->pdf->Cell(0,6,"Father's name: ",0,1,'L',false);
      $this->pdf->setXY(63,61);
      $this->pdf->Cell(68,6,$this->father_name,'B',1,'C',false);

      $this->pdf->setXY(141,55);
      $this->pdf->Cell(40,6,"Age: ",0,0,'L',false);
      $this->pdf->setXY(160,55);
      $this->pdf->Cell(25,5,$this->age,'B',0,'C',false);
      $this->pdf->setXY(185,55);
      $this->pdf->Cell(25,6,"Sex: ",0,0,'L',false);
      $this->pdf->setXY(195,55);
      $this->pdf->Cell(16,5,$this->sex,'B',0,'C',false);
      $this->pdf->setXY(211,55);
      $this->pdf->Cell(30,6,"Date: ",0,0,'L',false);
      $this->pdf->setXY(225,55);
      $this->pdf->Cell(35,5,$this->date,'B',1,'C',false);
      $this->pdf->setXY(141,60);
      $this->pdf->Cell(0,6,"Address: ",0,1,'L',false);
      $this->pdf->setXY(160,60);
      $this->pdf->Cell(100,5,$this->address,'B',1,'C',false);
    }

    private function _createBody(){
      $this->pdf->SetFont('Calibri Bold','B',11);
      $this->pdf->setXY(25,80);
      $this->pdf->Cell(70,6,'',"LTR",0,'C',false);
      $this->pdf->Cell(180,6,'Recommended Age',1,1,'C',false);
      $this->pdf->setXY(25,86);
      $this->pdf->Cell(70,6,'Vaccine',"LBR",0,'C',false);
      $this->pdf->Cell(30,6,'Upon Birth',1,0,'C',false);
      $this->pdf->Cell(30,6,'1½ Month',1,0,'C',false);
      $this->pdf->Cell(30,6,'2½ Month',1,0,'C',false);
      $this->pdf->Cell(30,6,'3½ Month',1,0,'C',false);
      $this->pdf->Cell(30,6,'9 Month',1,0,'C',false);
      $this->pdf->Cell(30,6,'1 Year',1,1,'C',false);
      foreach ($this->vaccines as $key => $vaccine) {
        $this->pdf->setX(25);
        $this->pdf->Cell(70,10,$vaccine['name'],1,0,'C',false);
        $this->pdf->Cell(30,10,'',1,0,'C',false);
        $this->pdf->Cell(30,10,'',1,0,'C',false);
        $this->pdf->Cell(30,10,'',1,0,'C',false);
        $this->pdf->Cell(30,10,'',1,0,'C',false);
        $this->pdf->Cell(30,10,'',1,0,'C',false);
        $this->pdf->Cell(30,10,'',1,1,'C',false);
      }
      $x = 95;
      $this->pdf->SetFillColor(92,255,92);
      foreach ($this->data as $key => $vaccination) {
        foreach ($vaccination as $key => $vaccine) {
          switch ($vaccine['vaccine_id']) {
            case 1:
            $this->pdf->setXY($x,92);
            $this->pdf->Cell(30,10,'DONE',1,0,'C',true);
              break;
            case 2:
            $this->pdf->setXY($x,102);
            $this->pdf->Cell(30,10,'DONE',1,0,'C',true);
              break;
            case 3:
            $this->pdf->setXY($x,112);
            $this->pdf->Cell(30,10,'DONE',1,0,'C',true);
              break;
            case 4:
            $this->pdf->setXY($x,122);
            $this->pdf->Cell(30,10,'DONE',1,0,'C',true);
              break;
            case 5:
            $this->pdf->setXY($x,132);
            $this->pdf->Cell(30,10,'DONE',1,0,'C',true);
              break;
            case 6:
            $this->pdf->setXY($x,142);
            $this->pdf->Cell(30,10,'DONE',1,1,'C',true);
              break;
            case 7:
            $this->pdf->setXY($x,152);
            $this->pdf->Cell(30,10,'DONE',1,1,'C',true);
              break;
          }
        }
        $x += 30;
      }
    }

    private function _createFooter(){
      $this->pdf->SetAutoPageBreak(true,1);
      $this->pdf->SetFont('Calibri','',11);
      $this->pdf->setXY(215,190);
      $this->pdf->Cell(55,4,$this->personnel,'B',0,'C',false);
      $this->pdf->setXY(215,195);
      $this->pdf->SetFont('Calibri','',10);
      $this->pdf->Cell(55,4,'Signature',0,0,'C',false);
    }


    public function generate(){
      $this->_initpdf();
      $this->_createHeader();
      $this->_createInfo();
      $this->_createBody();
      $this->_createFooter();
      $this->pdf->output('I', $this->child_name."-prescription ".date('Y-m-d').".pdf");
    }

  }
