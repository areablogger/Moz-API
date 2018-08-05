<?php echo form_open('moz/grabdata');?>
<input type="url" name="url" placeholder="url"/>
<input type="submit" name="submit" value="Submit"/>
</form>

<?php
print_r($datamoz);
?>
