<?php

/* 
 * User Role Editor On Screen Help class
 * 
 */

class URE_Screen_Help {
    
    protected function get_general_tab() {
    
        $text = '<h2>User Role Editor Options page help</h2>
            <p>
            <ul>
            <li><strong>' . esc_html__('Show Administrator role at User Role Editor', 'ure').'</strong> - ' .
                esc_html__('turn this option on in order to make the "Administrator" role available at the User Role Editor '
                        . 'roles selection drop-down list. It is hidden by default for security reasons.','ure') . '</li>
            <li><strong>' . esc_html__('Show capabilities in the human readable form','ure').'</strong> - ' .
                esc_html__('automatically converts capability names from the technical form for internal use like '
                        . '"edit_others_posts" to more user friendly form, e.g. "Edit others posts".','ure') . '</li>
            <li><strong>' . esc_html__('Show deprecated capabilities','ure').'</strong> - '.
                esc_html__('Capabilities like "level_0", "level_1" are deprecated and are not used by WordPress. '
                        . 'They are left at the user roles for the compatibility purpose with the old themes and plugins code. '
                        . 'Turning on this option will show those deprecated capabilities.', 'ure') . '</li>';

        $text = apply_filters('ure_get_settings_general_tab_help', $text);
        $text .='
            </ul>
                </p>';
        
        return $text;
    }
    // end of get_general_tab()


    protected function get_additional_modules_tab() {
        $text = '<h2>User Role Editor Options page help</h2>
            <p>
            <ul>
            <li><strong>' . esc_html__('Count users without role', 'ure').'</strong> - ' .
                esc_html__('select roles below','ure') . '</li>';        
        $text = apply_filters('ure_get_settings_additional_modules_tab_help', $text);
        $text .='
            </ul>
                </p>';        
        
        return $text;
    }
    // end of get_additional_modules_tab()

    
    protected function get_default_roles_tab() {
        $text = '<h2>User Role Editor Options page help</h2>
            <p>
            <ul>
            <li><strong>' . esc_html__('Other default roles for new registered user', 'ure').'</strong> - ' .
                esc_html__('select roles below to assign them to the new user automatically as an addition to the primary role. '.
                'Note for multisite environment: take into account that other default roles should exist at the site, '. 
                'in order to be assigned to the new registered users.','ure') . '</li>';        
        
        $text = apply_filters('ure_get_settings_default_roles_tab_help', $text);
        $text .='
            </ul>
                </p>';
        
        return $text;
    }
    // end of get_default_roles_tab()
    
    
    protected function get_multisite_tab() {
        $text = '<h2>User Role Editor Options page help</h2>
            <p>
            <ul>
                <li><strong>' . esc_html__('Allow non super-admininstrators to create, edit and delete users', 'ure').'</strong> - ' .
                esc_html__('Super administrator only may create, edit and delete users under WordPress multi-site by default. ' 
                        . 'Turn this option on in order to remove this limitation.','ure') . '</li>';
        
        $text = apply_filters('ure_get_settings_multisite_tab_help', $text);
        $text .='
            </ul>
                </p>';
        
        return $text;
    }
    // end of get_multisite_tab()
    
            
    public function get_settings_help($tab_name) {
        switch ($tab_name) {
            case 'general':{
                $text = $this->get_general_tab();
                break;
            }
            case 'additional_modules':{
                $text = $this->get_additional_modules_tab();
                break;
            }
            case 'default_roles':{
                $text = $this->get_default_roles_tab();
                break;
            }
            case 'multisite':{
                $text = $this->get_multisite_tab();
                break;
            }
            default: 
        }
        
        return $text;
    }
    // end of get_settings_help()

    
}
// end of URE_Screen_Help