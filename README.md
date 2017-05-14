# Observetable
Implementation of adding an Observer to an observable class in Joomla CMS (you will find a Library to install the new Observer and a System plugin to add the new Observer)

Joomla provides 2 observers on JTable : Tags and ContentHistory
This repository is dedicated to the add of an Content Observer on the class JTable (which is observable).

## JTableObserverContent
This Observer will provide modifications on the following JTable events :
* onBeforeLoad
* onAfterLoad
* onBeforeStore
* onAfterStore
* onBeforeDelete
* onAfterDelete

See API documententation to know more on these events :
* english : https://api.joomla.org/cms-3/classes/JTableObserver.html
* french : https://api.joomla.fr/joomla3/df/d52/classJTableObserver.html

## Extensions to use
To make it works, you need :
1. install a library that add your observer to the system
2. a System plugin that implement adding the relation between Observer/Observable classes through the JObserverMapper

