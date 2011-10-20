EBlueprintWidget widget
=======================

Виджет регистрирует Blueprint CSS Framework в верстку.
Вставьте виджет сразу после head-тега:
~~~
[php]
$this->widget('ext.yiiext.widgets.blueprint.EBlueprintWidget', array(
	'plugins' => array('buttons','fancy-type','link-icons','rtl','sprites',),
));
~~~
