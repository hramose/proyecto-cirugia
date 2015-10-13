<?php
class PostController extends Controller
{
    public function actions()
    {
        return array(
            'fileUpload'=>array(
                'class'=>'ext.redactor.actions.FileUpload',
                'uploadCreate'=>true,
                'permissions'=>0755,
            ),
            'imageUpload'=>array(
                'class'=>'ext.redactor.actions.ImageUpload',
                'uploadCreate'=>true,
                'permissions'=>0755,
            ),
            'imageList'=>array(
                'class'=>'ext.redactor.actions.ImageList',
            ),
        );
    }

}