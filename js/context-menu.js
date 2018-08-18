	var contextMenuObj;
	var MSIE = navigator.userAgent.indexOf('MSIE')?true:false;
	var navigatorVersion = navigator.appVersion.replace(/.*?MSIE (\d\.\d).*/g,'$1')/1;	
	var activeContextMenuItem = false;
	var contextMenuSource = false;	// Reference to element calling the context menu
	
	
	document.documentElement.onclick = autoHideContextMenu;
	function autoHideContextMenu(e)
	{
		if(!contextMenuObj)return;
		if(document.all)e = event;
		if (e.target) source = e.target;
			else if (e.srcElement) source = e.srcElement;
			if (source.nodeType == 3) // defeat Safari bug
				source = source.parentNode;

		var tag1 = source;
		var tag2 = source;
		var tag3 = source;
		if(tag1.parentNode)tag2 = tag1.parentNode;
		if(tag1.parentNode.parentNode)tag3 = tag1.parentNode.parentNode;
		
		if(tag1.tagName!='contextMenu' && tag2.tagName!='contextMenu' && tag3.tagName!='contextMenu')contextMenuObj.style.display='none';	
		
	}
	
	function showContextMenu(e)
	{
		contextMenuSource = this;
		if(activeContextMenuItem)activeContextMenuItem.className='';
		if(document.all)e = event;
		var xPos = e.clientX;
		if(xPos + contextMenuObj.offsetWidth > (document.documentElement.offsetWidth-20)){
			xPos = xPos + (document.documentElement.offsetWidth - (xPos + contextMenuObj.offsetWidth)) - 20;	
		}
		
		var yPos = e.clientY;
		if(yPos + contextMenuObj.offsetHeight > (document.documentElement.offsetHeight-20)){
			yPos = yPos + (document.documentElement.offsetHeight - (yPos + contextMenuObj.offsetHeight)) - 20;	
		}		
		contextMenuObj.style.left = xPos + 'px';
		contextMenuObj.style.top = yPos + 'px';
		contextMenuObj.style.display='block';
		return false;	
	}
	