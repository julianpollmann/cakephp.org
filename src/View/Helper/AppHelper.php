<?php
namespace App\View\Helper;

use Cake\View\Helper;
use Cake\Utility\Hash;

class AppHelper extends Helper
{
    public $helpers = ['Html'];

    /**
     * Outputs the footer menu items
     *
     * @param array $items
     * @return string
     */
    public function menuItems($items)
    {
        $result = '';

        foreach ($items as $title => $options) {
            $class = '';
            $icon = 'fa fa-menu fa-chevron-right';
            $url = $options;
            $linkOptions = ['escape' => false];

            if (is_array($options)) {
                $icon = Hash::get($options, 'icon', $icon);
                $url = Hash::get($options, 'url', '#');
                $class = Hash::get($options, 'class', '');
                $linkOptions = array_merge($linkOptions, Hash::get($options, 'options', []));
            }

            $link = $this->Html->link(
                $this->Html->tag('i', '', ['class' => $icon]) . __($title),
                $url,
                $linkOptions
            );

            $result .= $this->Html->tag('li', $link, ['class' => $class]);
        }

        return $result;
    }

	/**
	 * Checks the active and return active class
	 *
	 * @param string $controller
	 * @return string
	 */
	public function active($controller)
	{
		return strtolower($this->request->controller) == strtolower($controller) ? 'active' : '';
	}
}
