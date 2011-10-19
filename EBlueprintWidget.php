<?php
/**
 * EBlueprintWidget class file.
 *
 * @author Veaceslav Medvedev <slavcopost@gmail.com>
 * @link http://code.google.com/p/yiiext/
 * @license http://www.opensource.org/licenses/bsd-license.php
 */
/**
 * Blueprint Widget
 *
 * EBlueprintWidget widget insert a Blueprint CSS Framework in your layout.
 *
 * Insert widget in your layout, after head-tag.
 * <pre>
 * $this->widget('ext.yiiext.widgets.blueprint.EBlueprintWidget');
 * </pre>
 *
 * @author Veaceslav Medvedev <slavcopost@gmail.com>
 * @version 0.2
 * @package yiiext.widgets.blueprint
 */
class EBlueprintWidget extends CWidget
{
	public $plugins=array();

	// Url to vendors css-files.
	private $_baseUrl;
	private $_basePUrl;
	private $_debug;

	private $_installedPlagins = array(
		'buttons','fancy-type','link-icons','rtl','sprites',
	);

	public function init()
	{
		if($this->_debug===null)
			$this->_debug = YII_DEBUG;

		foreach($this->getCssFiles($this->_debug) as $file)
		{
			if(isset($file[2]))
				echo '<!--[if lt IE '.$file[2].']>'."\n";
			echo CHtml::cssFile($file[0],isset($file[1]) ? $file[1] : '')."\n";
			if(isset($file[2]))
				echo '<![endif]-->'."\n";
		}

		foreach($this->plugins as $plugin)
		{
			if($this->isPlaginInstalled($plugin))
				echo CHtml::cssFile($this->_basePUrl.'/'.$plugin.'/screen.css','screen,projection')."\n";
		}
	}
	public function getCssFiles($debug=false)
	{
		if($this->_baseUrl===null)
			$this->_baseUrl=Yii::app()->getAssetManager()->publish(dirname(__FILE__).'/vendors/joshuaclayton-blueprint-css/blueprint');

		if($debug)
		{
			return array(
				array($this->_baseUrl.'/src/reset.css','screen,projection'),
				array($this->_baseUrl.'/src/typography.css','screen,projection'),
				array($this->_baseUrl.'/src/grid.css','screen,projection'),
				array($this->_baseUrl.'/src/forms.css','screen,projection'),
				array($this->_baseUrl.'/src/print.css','print'),
				array($this->_baseUrl.'/src/ie.css','screen,projection','8'),
			);
		}
		else
		{
			return array(
				array($this->_baseUrl.'/screen.css','screen,projection'),
				array($this->_baseUrl.'/print.css','print'),
				array($this->_baseUrl.'/ie.css','screen,projection','8'),
			);
		}
	}

	public function isPlaginInstalled($plugin)
	{
		if($this->_basePUrl===null)
			$this->_basePUrl=Yii::app()->getAssetManager()->publish(dirname(__FILE__).'/vendors/joshuaclayton-blueprint-css/plugins');

		if(in_array($plugin, $this->_installedPlagins))
			return true;

		return false;
	}
}
