<?php

add_action('widgets_init', 'esp_project_portfolio_load_widget');

function esp_project_portfolio_load_widget()
{
    register_widget('ProjectPortfolio');
}

class ProjectPortfolio extends WP_Widget
{


    function ProjectPortfolio()
    {

        $widget_ops = array('classname' => 'projectportfolio', 'description' => __('Project prtfolio settings', 'projectportfolio'));

        $control_ops = array('width' => 300, 'height' => 350, 'id_base' => 'project-portfolio-widget');

        $this->WP_Widget('project-portfolio-widget', __('Project prtfolio', 'projectportfolio'), $widget_ops, $control_ops);
    }


    function widget($args, $instance)
    {
        extract($args);

        $quick_contact_email = apply_filters('project_portfolio_widget_title', $instance['project_portfolio_widget_title']);

        echo $before_widget;

        echo $before_title . "Rain" . $after_title;

        if (isset($_POST['c_check'])) {


            $c_name = $_POST['c_name'];
            $c_subject = $_POST['c_subject'];
            $c_body = $_POST['c_body'] . ' From: ' . $c_name;

            $c_send = wp_mail($quick_contact_email, $c_subject, $c_body);
            if ($c_send) {
                echo 'Message sent';
            }
        } else {
            echo '<form action="' . $_SERVER['PHP_SELF'] . '" method="POST">
		Name<br /><input type="text" name="c_name" />
		<br />Subject<br /><input type="text" name="c_subject" />
		<br />Body<br /><textarea name="c_body"></textarea>
		<input type="hidden" name="c_check" />
		<br /><input type="submit" name="c_submit" value="Send" />
		</form>';
        }
        echo $after_widget;

    }

    function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $instance['project_portfolio_widget_title'] = $new_instance['project_portfolio_widget_title'];
        return $instance;
    }

    function form($instance)
    {

        $defaults = array('project_portfolio_widget_title' => __('', 'projectportfolio'));
        $instance = wp_parse_args((array)$instance, $defaults);?>
        <p>
            <label for="<?php echo $this->get_field_id('project_portfolio_widget_title'); ?>">
                <?php _e('Enter Widget Title', 'hybrid'); ?>
            </label>
            <input type="text" id="<?php echo $this->get_field_id('project_portfolio_widget_title'); ?>"
                   name="<?php echo $this->get_field_name('project_portfolio_widget_title'); ?>" style="width:100%;"
                   value="<?php echo $instance['project_portfolio_widget_title']; ?>"/>
        </p>
<?php
    }
}
?>