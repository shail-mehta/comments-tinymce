		addComment = {
	    moveForm : function(commId, parentId, respondId, postId) {
	        var ctf = this;
	        // Remove editor if necessary
	        ctf.red();
	        var div,
	        comm = ctf.ctf_id(commId),
	        respond = ctf.ctf_id(respondId),
	        cancel = ctf.ctf_id('cancel-comment-reply-link'),
	        parent = ctf.ctf_id('comment_parent'), post = ctf.ctf_id('comment_post_ID');
	        if ( ! comm || ! respond || ! cancel || ! parent)
	                return;
	        ctf.respondId = respondId;
	        postId = postId || false;
	        if ( ! ctf.ctf_id('wp-temp-form-div') ) {
	                div = document.createElement('div');
	                div.id = 'wp-temp-form-div';
	                div.style.display = 'none';
	                respond.parentNode.insertBefore(div, respond);
	        }
	        comm.parentNode.insertBefore(respond, comm.nextSibling);
	        if ( post && postId )
	            post.value = postId;
	        	parent.value = parentId;
	        	cancel.style.display = '';
	        // Add editor if necessary
	        ctf.aed();
	        cancel.onclick = function() {
	            var ctf = addComment;
	            // Remove editor if necessary
	            ctf.red();
	            var temp = ctf.ctf_id('wp-temp-form-div'), respond = ctf.ctf_id(ctf.respondId);
	            if ( ! temp || ! respond )
	                return;
	            ctf.ctf_id('comment_parent').value = '0';
	            temp.parentNode.insertBefore(respond, temp);
	            temp.parentNode.removeChild(temp);
	            this.style.display = 'none';
	            this.onclick = null;
	            // Add editor if necessary
	            ctf.aed();
	            return false;
	        }
	        return false;
	    },
	    ctf_id : function(e) {
	        return document.getElementById(e);
	    },
	    red : function() {
	        if(typeof(tinyMCE) == 'undefined')
	            return;
	        var tmce = tinyMCE.get('comment');
	        if (tmce && !tmce.isHidden()){
	            this.mode = 'tmce';
	            tmce.remove();
	        }else{
	            this.mode = 'html';
	        }
	    },
	   
	}