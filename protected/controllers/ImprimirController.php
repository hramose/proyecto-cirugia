<?php

class ImprimirController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';
	
	public function actionPresupuesto()
	{
		/*$this->layout="//layouts/pdf_2";*/
		
		if(isset($_GET['pdf'])){
		$this->layout = "dialoglayout";
/*				$this->layout="//layouts/pdf_2";*/
				$mPDF1 = Yii::app()->ePdf->mpdf();
				$stylesheet = file_get_contents(Yii::getPathOfAlias('webroot').'/css/print.css');
				$mPDF1->WriteHTML($stylesheet, 1);
				$mPDF1->WriteHTML($this->render('factura',array(),true));
				$mPDF1->SetFooter ("Impreso por: ".Yii::app()->user->name."             ".date("d-m-Y h:i:s A"));
				$mPDF1->Output();				
			}
		
		
		$this->layout = "dialoglayout";
	    $this->render('presupuesto');
	}


	public function actionContratos()
	{
		/*$this->layout="//layouts/pdf_2";*/
		
		//if(isset($_GET['pdf'])){
		//$this->layout = "dialoglayout";
/*				$this->layout="//layouts/pdf_2";*/

				$mPDF1 = Yii::app()->ePdf->HTML2PDF();
				$mPDF1->WriteHTML($this->renderPartial('contratos', array(), true));
        		$mPDF1->Output();
			//}
		
		$this->layout = "dialoglayout";
	    $this->render('contratos');
	}

	public function actionIngresos()
	{
		/*$this->layout="//layouts/pdf_2";*/
		
		//if(isset($_GET['pdf'])){
		//$this->layout = "dialoglayout";
/*				$this->layout="//layouts/pdf_2";*/

				$mPDF1 = Yii::app()->ePdf->HTML2PDF();
				$mPDF1->WriteHTML($this->renderPartial('ingresos', array(), true));
        		$mPDF1->Output();
			//}
		
		$this->layout = "dialoglayout";
	    $this->render('ingresos');
	}


	public function actionVerCita($id)
	{
		/*$this->layout="//layouts/pdf_2";*/
		
		
		$this->layout = "dialoglayout";
	    $this->render('verCita');
	}

	public function actionFacturaCf()
	{
		/*$this->layout="//layouts/pdf_2";*/
		
		if(isset($_GET['pdf'])){
		$this->layout = "dialoglayout";
/*				$this->layout="//layouts/pdf_2";*/
				$mPDF1 = Yii::app()->ePdf->mpdf();
				$stylesheet = file_get_contents(Yii::getPathOfAlias('webroot').'/css/print.css');
				$mPDF1->WriteHTML($stylesheet, 1);
				$mPDF1->WriteHTML($this->render('facturaCf',array(),true));
				$mPDF1->SetFooter ("Impreso por: ".Yii::app()->user->name."             ".date("d-m-Y h:i:s A"));
				$mPDF1->Output();				
			}
		
		
		$this->layout = "dialoglayout";
	    $this->render('facturaCf');
	}

	public function actionHuespedes()
	{
		/*$this->layout="//layouts/pdf_2";*/
		
		if(isset($_GET['pdf'])){
		$this->layout = "dialoglayout";
/*				$this->layout="//layouts/pdf_2";*/
				$mPDF1 = Yii::app()->ePdf->mpdf();
				$stylesheet = file_get_contents(Yii::getPathOfAlias('webroot').'/css/print.css');
				$mPDF1->WriteHTML($stylesheet, 1);
				$mPDF1->WriteHTML($this->render('huespedes',array(),true));
				$mPDF1->SetFooter ("Impreso por: ".Yii::app()->user->name."             ".date("d-m-Y h:i:s A"));
				$mPDF1->Output();

			}
		
		
		$this->layout = "dialoglayout";
	    $this->render('huespedes');
	}

		public function actionReservaciones()
	{
		/*$this->layout="//layouts/pdf_2";*/
		
		if(isset($_GET['pdf'])){
		$this->layout = "dialoglayout";
/*				$this->layout="//layouts/pdf_2";*/
				$mPDF1 = Yii::app()->ePdf->mpdf();
				$stylesheet = file_get_contents(Yii::getPathOfAlias('webroot').'/css/print.css');
				$mPDF1->WriteHTML($stylesheet, 1);
				$mPDF1->WriteHTML($this->render('reservaciones',array(),true));
				$mPDF1->SetFooter ("Impreso por: ".Yii::app()->user->name."             ".date("d-m-Y h:i:s A"));
				$mPDF1->Output();				
			}
		
		
		$this->layout = "dialoglayout";
	    $this->render('reservaciones');
	}

}
