function addEventListeners() {
  // New post listener
  if (window.location.pathname == "/homepage"){
    let postCreator = document.querySelector('div.publish-card form.new_post');
    
    if(postCreator != null)
      postCreator.addEventListener('submit', sendCreatePostRequest);
  }

  // Post delete listener
  let postDeleter = document.querySelectorAll('article.post div.post-header a.delete-post');
  [].forEach.call(postDeleter, function(deleter){
    deleter.addEventListener('click', sendDeletePostRequest);
  });

  let editProfileButton = document.querySelector('button#editProfileButton');
  if (editProfileButton != null) editProfileButton.addEventListener('click', openEditProfileModal);

  let notificationsButton = document.getElementById('notifications_button');
  notificationsButton.onclick = getNotifications;

  // New comment listener
  let commentCreator = document.querySelector('section.add-comment div#collapseForm form.newComment');
  if(commentCreator != null)
    commentCreator.addEventListener('submit', sendCreateCommentRequest)

  // New subcomment listener
  let subcommentCreator = document.querySelectorAll('section.add-subcomment div.subcomment-form form.new-subcomment');
  [].forEach.call(subcommentCreator, function(creator) {
    creator.addEventListener('submit', sendCreateSubcomment);
  });
}

function encodeForAjax(data) {
  if (data == null) return null;
  return Object.keys(data).map(function(k){
    return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
  }).join('&');
}

function sendAjaxRequest(method, url, data, handler) {
  let request = new XMLHttpRequest();

  request.open(method, url, true);
  request.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').content);
  request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  request.addEventListener('load', handler);
  request.send(encodeForAjax(data));
}

function sendCreatePostRequest(event) {
  let content = this.querySelector('textarea.post-content').value;

  if(content != '')
    sendAjaxRequest('put', '/api/posts/', {content: content}, postAddedHandler);

  event.preventDefault();
}

function postAddedHandler() {
  if (this.status != 200) window.location ='/homepage';

  let post = JSON.parse(this.responseText);

  let new_post = createPost(post);
  
  let form = document.querySelector('div.publish-card form.new_post');
  form.querySelector('textarea.post-content').value="";

  let section = document.getElementById('posts');
  let first_post = document.querySelector('.post');
  
  section.insertBefore(new_post, first_post);
}

function createPost(post) {
  let new_post = document.createElement('article');
  new_post.classList.add('card');
  new_post.classList.add('post');
  new_post.classList.add('post-margins');
  new_post.setAttribute('data-id', post.post.id);
  
  new_post.innerHTML = `
    <div class="post-header d-flex justify-content-between">
      <div class="post-header-left">
        <a href="/users/${post.post.author_id}"><i class="icon-user post-user-icon"></i>${post.name}</a>
        <a href="/cu/${post.post.cu_id}" class="badge badge-pill badge-primary cu-badge">${post.abbrev == undefined ? "" : post.abbrev}</a>
      </div>

      <a class="delete-post"><i class="icon-trash post-delete"></i></a>
    </div>

    <div class="card-body">
      ${post.post.content }
    </div>

    <div class="post-footer">
      <a href="/post/${post.post.id}" class="number-comments">0 comments</a>
    </div>
  `;

  let trash = new_post.querySelector('div.post-header a.delete-post');
  trash.addEventListener('click', sendDeletePostRequest);


  return new_post;
}

function sendDeletePostRequest(event) {
  let id=this.closest('article').getAttribute('data-id');
  
  sendAjaxRequest('delete', '/api/posts/' + id, null, postDeletedHandler);
}

function postDeletedHandler() {
  if(this.status != 200) {
    window.location = '/homepage';
    return;
  } 
  
  let post = JSON.parse(this.responseText);
  
  let article = document.querySelector('article.post[data-id="' + post.id + '"]');
  article.remove();
}

function openEditProfileModal() {
  console.log("clicked");
}

function sendCreateCommentRequest(event) {
  let content = this.querySelector('textarea.comment-content').value;
  let postId = document.querySelector('article.post').getAttribute('data-id');
  
  if(content != '')
    sendAjaxRequest('put', '/api/comments/', {content: content, postId: postId}, commentAddedHandler);

  event.preventDefault();
}

function commentAddedHandler() {
  if (this.status != 200) window.location ='/homepage';

  let comment = JSON.parse(this.responseText);
  
  let new_comment = createComment(comment);
  
  let form = document.querySelector('section.add-comment div#collapseForm form.newComment') 
  form.querySelector('textarea.comment-content').value="";

  let section = document.getElementById('comments');
  
  section.insertAdjacentElement('afterbegin', new_comment);
}

function createComment(comment) {
  let new_comment = document.createElement('article');
  new_comment.classList.add('card');
  new_comment.classList.add('comment');
  new_comment.setAttribute('data-id', comment.comment.id);
  
  new_comment.innerHTML = `
    <div class="comment-header">
      <a href="/users/${comment.comment.author_id}"><i class="icon-user post-user-icon"></i>${comment.name}</a>
    </div>

    <div class="card-body">
      ${comment.comment.content }
    </div>
  `;

  return new_comment;
}

function sendCreateSubcomment(event) {
  let content = this.querySelector('textarea.subcomment-content').value;
  let postId = document.querySelector('article.post').getAttribute('data-id');
  let commentId = this.getAttribute('data-id');
	
  if(content != '')
    sendAjaxRequest('put', `/api/comment/${commentId}/subcomments`, {content: content, postId: postId}, subcommentAddedHandler);

  event.preventDefault();
}

function subcommentAddedHandler() {
	if(this.status != 200) window.location = '/homepage';

	let subcomment = JSON.parse(this.responseText);
	
	let new_subcomment = createSubcomment(subcomment);
	let parentId = subcomment.parentId;
	
	let form = document.querySelector(`section.add-subcomment div.comment${parentId} form.new-subcomment`);
	form.querySelector('textarea.subcomment-content').value = "";

	let section = document.getElementById(`subcomments${parentId}`);
  let lastSubComment = section.querySelector('article.subcomment:last-of-type');
 
  if(lastSubComment == null)
    section.insertAdjacentElement('afterbegin', new_subcomment)
  else
    section.insertBefore(new_subcomment, lastSubComment.nextSibling);
}

function createSubcomment(subcomment) {
	let new_subcomment = document.createElement('article');
	new_subcomment.classList.add('card');
	new_subcomment.classList.add('subcomment');
	new_subcomment.setAttribute('data-id', subcomment.subcomment.id);

	new_subcomment.innerHTML = `
	<div class="subcomment-header">
		<a href="/users/${subcomment.subcomment.author_id}"><i class="icon-user post-user-icon"></i>${subcomment.name}</a>
	</div>

	<div class="card-body">
		${subcomment.subcomment.content }
	</div>
	`;

	return new_subcomment;
}

//CUs
let content_elem = document.getElementById("data");
let id;
if (document.getElementById("cu_id") != null) id = document.getElementById("cu_id").value;

let feed_btn = document.getElementById("feed_btn");
let doubts_btn = document.getElementById("doubts_btn");
let tutor_btn = document.getElementById("tutor_btn");
let classes_btn = document.getElementById("classes_btn");
let about_btn = document.getElementById("about_btn");

let btn_grp = document.getElementById("cu_tabs");
let msg_area = document.getElementsByClassName("publish-card")[0];

function disable_posting(){
    msg_area.readonly = true;
    msg_area.style.display = "none";
}

function enable_posting(){
    msg_area.readonly = false;
    msg_area.style.display = "";

}

function vert_hor() {
    if (window.innerWidth < 992) btn_grp.className = "btn-group btn-group-toggle d-flex flex-wrap justify-content-center";
    else btn_grp.className = "btn-group-vertical btn-group-toggle d-flex flex-wrap justify-content-center";

}

function sendCreateGenPostRequest(event) {
    let content = this.querySelector('textarea.post-content').value;
  
    if(content != '')
      sendAjaxRequest('put', '/api/posts/' + id + "/" + "General", {content: content}, postAddedHandler);
  
    event.preventDefault();
}

function sendCreateDoubtsPostRequest(event) {
    let content = this.querySelector('textarea.post-content').value;
  
    if(content != '')
      sendAjaxRequest('put', '/api/posts/' + id + "/" + "Doubts", {content: content}, postAddedHandler);
  
    event.preventDefault();
}

function sendCreateTutorPostRequest(event) {
    let content = this.querySelector('textarea.post-content').value;
  
    if(content != '')
      sendAjaxRequest('put', '/api/posts/' + id + "/" + "Tutoring", {content: content}, postAddedHandler);
  
    event.preventDefault();
}

function getFeed() {
    about_btn.style.textDecoration = "";
    classes_btn.style.textDecoration = "";
    tutor_btn.style.textDecoration = "";
    doubts_btn.style.textDecoration = "";
    feed_btn.style.textDecoration = "underline";
    let req = new XMLHttpRequest();
    req.open("GET", "/cu/" + id + "/feed/", true);

    req.onload = function () {
        if (req.status >= 200 && req.status < 400){
            let content_str = "<section id=\"posts\">" +this.responseText + "</section>";
            content_elem.innerHTML = content_str;
            addEventListeners();
        }

        else content_elem.innerHTML = "There was an error retrieving this CUs posts from our database, try another time";
    };

    req.send();
    enable_posting();
    let postCreator = document.querySelector('div.publish-card form.new_post');
    postCreator.onsubmit = sendCreateGenPostRequest;
    postCreator.removeEventListener('submit', sendCreatePostRequest);
}

function getDoubts() {
    about_btn.style.textDecoration = "";
    classes_btn.style.textDecoration = "";
    tutor_btn.style.textDecoration = "";
    feed_btn.style.textDecoration = "";
    doubts_btn.style.textDecoration = "underline";
    let req = new XMLHttpRequest();
    req.open("GET", "/cu/" + id + "/doubts/", true);

    req.onload = function () {
        if (req.status >= 200 && req.status < 400){
            let content_str = "<section id=\"posts\">" +this.responseText + "</section>";
            content_elem.innerHTML = content_str;
            addEventListeners();
        }
    };

    req.send();
    enable_posting();
    let postCreator = document.querySelector('div.publish-card form.new_post');
    postCreator.onsubmit = sendCreateDoubtsPostRequest;
    postCreator.removeEventListener('submit', sendCreatePostRequest);
}

function getTutoring(){
    about_btn.style.textDecoration = "";
    classes_btn.style.textDecoration = "";
    doubts_btn.style.textDecoration = "";
    feed_btn.style.textDecoration = "";
    tutor_btn.style.textDecoration = "underline";
    let req = new XMLHttpRequest();
    req.open("GET",  "/cu/" + id + "/tutoring/", true);

    req.onload = function () {
        if (req.status >= 200 && req.status < 400){
            let content_str = "<section id=\"posts\">" +this.responseText + "</section>";
            content_elem.innerHTML = content_str;
            addEventListeners();
        }
    };

    req.send();
    enable_posting();
    let postCreator = document.querySelector('div.publish-card form.new_post');
    postCreator.onsubmit = sendCreateTutorPostRequest;
    postCreator.removeEventListener('submit', sendCreatePostRequest);
}

function getClasses(){
    about_btn.style.textDecoration = "";
    tutor_btn.style.textDecoration = "";
    doubts_btn.style.textDecoration = "";
    feed_btn.style.textDecoration = "";
    classes_btn.style.textDecoration = "underline";
    let req = new XMLHttpRequest();
    req.open("GET", "/cu/" + id + "/classes/", true);

    req.onload = function () {
        if (req.status >= 200 && req.status < 400) content_elem.innerHTML = this.responseText;
    };

    req.send();
    disable_posting();
}

function getAbout(){
    classes_btn.style.textDecoration = "";
    tutor_btn.style.textDecoration = "";
    doubts_btn.style.textDecoration = "";
    feed_btn.style.textDecoration = "";
    about_btn.style.textDecoration = "underline";
    let req = new XMLHttpRequest();
    req.open("GET",  "/cu/" + id + "/about/", true);

    req.onload = function () {
        if (req.status >= 200 && req.status < 400) content_elem.innerHTML = this.responseText;
    };

    req.send();
    disable_posting();
}

if (about_btn != null){
    about_btn.onclick = getAbout;
    classes_btn.onclick = getClasses;
    tutor_btn.onclick = getTutoring;
    doubts_btn.onclick = getDoubts;
    feed_btn.onclick = getFeed;
    window.onresize = vert_hor;

    vert_hor();
    getFeed();
}

function accessGrantedCU(notification){
    let req_str = "";
    req_str += "<a class=\"\" href=\"/cu/" + notification.content + "\">"
    req_str += "You have been granted access to vist the cu with code: " + notification.content; 
    req_str += "</a>";
    return req_str;
}

function pollNotifications(){
  let new_not = document.getElementById("new_notifications");

  if (new_not.className != ""){
    let req = new XMLHttpRequest();
    let id = document.getElementById("studentId").value;
    req.open("GET",  "/users/myNotifications/poll/" + id, true);
    req.onload = function(){
      if (this.responseText == "true") new_not.className = "";
    }
    req.send();
  }
}

function getNotifications(){
  let new_not = document.getElementById("new_notifications");
  let req = new XMLHttpRequest();
  let id = document.getElementById("studentId").value;
  let notification_area = document.getElementById("notification_area");
  notification_area.innerHTML = "";
  req.open("GET",  "/users/myNotifications/" + id, true);

  req.onload = function () {
      if (req.status >= 200 && req.status < 400){
        let notifications = JSON.parse(this.responseText).notifications;
        for (let i = 0; i < notifications.length; i++) {
          let req_str = "";
          if (i != 0) req_str += "<br>";
          if(notifications[i].notification_type == "AccessGrantedCU") req_str += accessGrantedCU(notifications[i]);
          else {
            req_str += "<div class=\"text-primary\">" + notifications[i].content + "</div>";
            console.log(req_str);
          }
          notification_area.innerHTML += req_str;
          notification_area.className = ""; 
        }

        new_not.className = "d-none";
      }

      else console.log(this.responseText);

      window.onclick = function(){
        notification_area.className = "d-none";
      }
  };


  req.send();
}

pollNotifications();
addEventListeners();
setInterval(pollNotifications, 5000);