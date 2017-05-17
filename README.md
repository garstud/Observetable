# Joomla! extensions : Observetable
Implementation of adding an Observer to an observable class in Joomla! CMS (here, you will find a Library to install the new Observer and a System plugin to add the new Observer in the system).

Joomla provides 2 observers on JTable : Tags and ContentHistory.

This repository is dedicated to the add of a new Content Observer on the class JTable (which is observable).

## JTableObserverContent
This Observer will provide modifications on the following JTable events :
* onBeforeLoad
* onAfterLoad
* onBeforeStore
* onAfterStore
* onBeforeDelete
* onAfterDelete

With these events, you may monitor and interact with many operations in JTable like :
* loading of an article
* save of an article
* delete one or many articles

See Joomla! API documententation to know more on these events :
* english : https://api.joomla.org/cms-3/classes/JTableObserver.html
* french : https://api.joomla.fr/joomla3/df/d52/classJTableObserver.html

## Extensions to use
To make it works, you need :
1. to install a Library that add your observer to the system
2. a System plugin that implement adding the relation between Observer/Observable classes through the JObserverMapper

## Known limitations
The use of Observer Design Pattern in Joomla to monitor an observable class like JTable is working fine, but for JTable there is some limitations. JTable is used to save or delete an article, but it is not be used in the following cases :
* Changing article status from the articles list in Backend
* Put an article in archive state from the articles list in Backend
* Set the feature flag from the articles list in Backend
* Reorder by drag'n drop articles from the articles list in Backend
* Using the batch/copy process
In fact, JTable is only used when making modifications in the edit view !
