<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */


$this->pageTitle=Yii::app()->name . ' - Login';

?>
<div class="page-header">
	<h1>Acceso <small>con tu cuenta</small></h1>
</div>
<div class="row-fluid">
	
    <div class="span6 offset3">
<?php
	$this->beginWidget('zii.widgets.CPortlet', array(
		'title'=>"<i class='icon-lock'></i>Acceso Privado",
	));
	
?>
    <p>Por favor llena el formulario con tus credenciales de acceso.</p>
    
	<table>
	<tr>
	<td>
	
    <div class="form">
    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'login-form',
        'enableClientValidation'=>true,
        'clientOptions'=>array(
            'validateOnSubmit'=>true,
        ),
    )); ?>
    
        <p class="note">Campos con <span class="required">*</span> son requeridos.</p>
        <div class="row">
            <div class="input-prepend">
                <?php echo $form->labelEx($model,'username'); ?>
                <span class="add-on"><i class="icon-user"></i></span>
                <?php echo $form->textField($model,'username'); ?>
            </div>
                <?php echo $form->error($model,'username'); ?>
        </div>
    
        
        <div class="row">
            <div class="input-prepend">
                <?php echo $form->labelEx($model,'password'); ?>
                <span class="add-on"><i class="icon-certificate"></i></span>
                <?php echo $form->passwordField($model,'password'); ?>
                <p class="hint">
                    <!--Hint: You may login with <kbd>demo</kbd>/<kbd>demo</kbd> or <kbd>admin</kbd>/<kbd>admin</kbd>.-->
                </p>
            </div>
                <?php echo $form->error($model,'password'); ?> 
        </div>
    
        
        <div class="row buttons">
            <?php echo CHtml::submitButton('Ingresar',array('class'=>'btn btn btn-primary')); ?>
           
            

        </div>
    
    <?php $this->endWidget(); ?>
    </div><!-- form -->
	</td>
	

	<td>
	<img src="images/candado.png"/></div>
	</td>
	</tr>
	</table>
<?php $this->endWidget();?>

    </div>

</div>