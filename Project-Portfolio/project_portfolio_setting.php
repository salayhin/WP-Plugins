<?php

global $wpdb;

$projectPortFolioTable = $wpdb->prefix . "project_portfolio";
settings_fields('portfolio-setting');

//Update submit value
if (!empty($_POST)) {

    for($cnt = 0; $cnt < 5; $cnt++)
    {
        $wpdb->update($projectPortFolioTable, array(
            'project_name'  => $_POST['project_name'][$cnt],
            'project_image' => $_POST['project_image'][$cnt],
            'project_link'  => $_POST['project_link'][$cnt],
        ), array('project_portfolio_id' => $_POST['id'][$cnt]));
    }
}

// Define form value
$data = $wpdb->get_results("SELECT * FROM $projectPortFolioTable");
$result = array();
for($cnt = 0; $cnt < 5; $cnt++)
{
    $result[$cnt]['project_name']  = (!empty($_POST['project_name'][$cnt])) ? $_POST['project_name'][$cnt] : $data[$cnt]->project_name;
    $result[$cnt]['project_image'] = (!empty($_POST['project_image'][$cnt])) ? $_POST['project_image'][$cnt] : $data[$cnt]->project_image;
    $result[$cnt]['project_link']  = (!empty($_POST['project_link'][$cnt])) ? $_POST['project_link'][$cnt] : $data[$cnt]->project_link;
}
?>

<div class="wrap">
    <h2>Project Portfolio Setting</h2>

    <?php if(!empty($_POST)) : ?>
    <div class="updated inline below-h2">
        <p>  Your setting is updated successfully.  </p>
    </div>
    <br/>
    <?php endif; ?>

    <form method="post" action="<?php echo $_SERVER['REQUEST_URI']?>">
        <?php wp_nonce_field('update-options'); ?>

        <table width="100%">
            <thead>
                <tr>
                    <td></td>
                    <td>Project Name</td>
                    <td>Project Thumb Image Link</td>
                    <td>Project Source Link</td>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td>Project-1</td>
                    <td>
                        <input type="text" name='project_name[]' value="<?php echo $result[0]['project_name'] ?>" />
                        <input type="hidden" name='id[]'  value = '1' />
                    </td>
                    <td><input type="text" name='project_image[]' value="<?php echo $result[0]['project_image'] ?>" /></td>
                    <td><input type="text" name='project_link[]'  value="<?php echo $result[0]['project_link'] ?>" /></td>
                </tr>
                <tr>
                    <td>Project-2</td>
                    <td>
                        <input type="text" name='project_name[]' value="<?php echo  $result[1]['project_name'] ?>" />
                        <input type="hidden" name='id[]'  value = '2' />
                    </td>
                    <td><input type="text" name='project_image[]' value="<?php echo $result[1]['project_image'] ?>" /></td>
                    <td><input type="text" name='project_link[]'  value="<?php echo $result[1]['project_link'] ?>" /></td>
                </tr>
                <tr>
                    <td>Project-3</td>
                    <td>
                        <input type="text" name='project_name[]'  value="<?php echo  $result[2]['project_name'] ?>" />
                        <input type="hidden" name='id[]'  value = '3' />
                    </td>
                    <td><input type="text" name='project_image[]' value="<?php echo  $result[2]['project_image'] ?>" /></td>
                    <td><input type="text" name='project_link[]' value="<?php echo $result[2]['project_link'] ?>" /></td>
                </tr>
                <tr>
                    <td>Project-4</td>
                    <td>
                        <input type="text" name='project_name[]'  value="<?php echo $result[3]['project_name'] ?>" />
                        <input type="hidden" name='id[]'  value = '4' />
                    </td>
                    <td><input type="text" name='project_image[]' value="<?php echo $result[3]['project_image'] ?>"/></td>
                    <td><input type="text" name='project_link[]' value="<?php echo $result[3]['project_link'] ?>"/></td>
                </tr>
                <tr>
                    <td>Project-5</td>
                    <td>
                        <input type="text" name='project_name[]'  value="<?php echo $result[4]['project_name'] ?>" />
                        <input type="hidden" name='id[]'  value = '5' />
                    </td>
                    <td><input type="text" name='project_image[]' value="<?php echo $result[4]['project_image'] ?>" /></td>
                    <td><input type="text" name='project_link[]' value="<?php echo $result[4]['project_link'] ?>" /></td>
                </tr>

            </tbody>
        </table>

        <div style="padding: 30px 0px 0px 400px;"><input type="submit" class="button-primary" name="save-project-portfolio"
                           value="<?php _e('Save Changes') ?>"/> </div>
        <input type="hidden" name="action" value="update"/>
    </form>
</div>