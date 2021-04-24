# omeka_asu_theme
Omeka theme with Bootstrap4 modeled after ASU's Comm template

# Instructions: 
Drag-drop into themes folder

# Issues:
Links are not relative: Some are completely broken
JS Hacks were put in place for MVP presentation
This is an exhibit theme not a full production theme
General bugs and mess.

# Edit Notes for Bootstrap Implementation in Omeka:
SimplePages
	/views/public/page/show.php
	add container for BS4
	
SimpleContactForm\
	/views/public/index/index.php\
	/views/public/index/thankyou.php\
	add container wrapper for form\
	
Contribution\
	/views/public/form.css\
	add \
	```
	.inputs.five.columns.omega{
	    padding-bottom: 20px;
	}
	#contribution-item-metadata{
	    padding-bottom: 20px;
	}```
	/views/public/contribution/contribute.php\
	ass container for BS4\
	
Guest User\
	/views/public/css/guest-user.css\
	add\
	````
	#confirm{
	    min-height: 50px;
	    margin-bottom: 20px;
	}
	.row{
	    margin-bottom: 0pm !important;
	}
	
	```
	
	

*This one is optional as I personally don't like "Social Bookmarking" as the label*
Social Bookmarking
	/helpers/SocialBookmarkingFunctions.php
	Change text in hookPulicItemsShow()
  
Specific Pages that need container encapsulation: 
About
Copyright
Contribution (Enable Contribution plugin first)

Keep SolrSeach as is. Do not download anything that will mess with the vews directory
