
<!-- BEGIN SAMPLE FORM PORTLET-->
<div class="row">
    <div class="col-md-12">
        <div class="portlet box blue ">
            <div class="portlet-body form">

                <?php  echo $this->Form->create('User',array('autocomplete'=>"off")); ?>
                <div class="form-body">
                    <div class="form-group">
                        <label class="control-label">new password	   :</label>

                        <?php echo $this->Form->input('new_password', array('autocomplete'=>"off",'type'=>'password','label' => false,'class' => 'form-control')); ?>
                    </div>
                    <div class="form-group">
                        <label class="control-label">retype password :</label>
                        <?php echo $this->Form->input('retype_password', array('autocomplete'=>"off",'type'=>'password','label' => false,'class' => 'form-control')); ?>
                    </div>
                    <div class="margin-top-10">
                        <?php echo $this->Form->button(__('<i class="fa fa-check"></i> Save'), array('class' => 'btn purchase-button btn btn-info btn-fw')); ?>

                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>