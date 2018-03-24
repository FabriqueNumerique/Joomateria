<?php defined('_JEXEC') or die('Restricted access');

JHTML::_('behavior.tooltip');
echo 'import';
?>
<form action="index.php?option=com_nemateria&controller=back" method="post" name="adminForm">
    <div class="col100">
            <fieldset class="adminform">
                <table class="admintable">
                    <?php 
                    echo '<legend>'.JText::_( 'COM_NEMATERIA_IMPORTATION' ).'</legend>';
                    echo '<h2>'.JText::_( 'COM_NEMATERIA_COLLECTION_HARVESTED' ).' : '.$this->item->title.'</h2>';
                    echo '<h2> '.JText::_( 'COM_NEMATERIA_YOU_IMPORTED' ).' : '.$this->import.' '.JText::_( 'COM_NEMATERIA_NOTICES' ).'</h2>';

                    echo '<h2>Information de la collection:</h2>
                            Spec : '.stripslashes($this->item->spec).'<br />
                            Description : '.stripslashes($this->item->description).'<br />
                            ';
                    echo '</table>'
                    ?>
                </table>
            </fieldset>
    </div>
    <?php echo JHTML::_( 'form.token' ); ?>
    <input type="hidden" name="option" value="com_nemateria" />
    <input type="hidden" name="task" value="" />
    <input type="hidden" name="boxchecked" value="0" />
    <input type="hidden" name="controller" value="notice" />
</form>
<div class="clr"></div>