function addEventListeners() {
  let postCreator = document.querySelector('div.publish-card form.new_post');
  if(postCreator != null)
    postCreator.addEventListener('submit', sendCreatePostRequest);

  let postDeleter = document.querySelectorAll('article.post div.post-header a.delete-post');
  [].forEach.call(postDeleter, function(deleter){
    deleter.addEventListener('click', sendDeletePostRequest);
  });

  let editProfileButton = document.querySelector('button#editProfileButton');
  if (editProfileButton != null) editProfileButton.addEventListener('click', openEditProfileModal);
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
      <a href="${post.id}"><i class="icon-user post-user"></i>${post.name}</a>
      <a class="delete-post"><i class="icon-trash post-delete"></i></a>
    </div>

    <div class="card-body">
      ${post.post.content }
    </div>

    <div class="post-footer">
      <a href="#" class="number-comments">X comments</a>
    </div>
  `;

  let trash = new_post.querySelector('div.post-header a.delete-post');
  trash.addEventListener('click', sendDeletePostRequest);


  return new_post;
}

function sendDeletePostRequest(event) {
  let id=this.closest('article').getAttribute('data-id');
  console.log("Post id:" + id);
  sendAjaxRequest('delete', '/api/posts/' + id, null, postDeletedHandler);
}

function postDeletedHandler() {
  console.log(this.status);
  console.log(this.responseText);
  if(this.status != 200) window.location = '/homepage';
  let post = JSON.parse(this.responseText);

  let article = document.querySelector('article.post[data-id="' + post.id + '"]');
  article.remove();
}

function openEditProfileModal() {
  console.log("clicked");
}

//CUs
let content_elem = document.getElementById("data");
let id = document.getElementById("cu_id").value;

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
		}

		else content_elem.innerHTML = "There was an error retrieving this CUs posts from our database, try another time";
		console.log(this.responseText);
	};

	req.send();
	enable_posting();
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
		if (req.status >= 200 && req.status < 400) content_elem.innerHTML = this.responseText;
	};

	req.send();
	enable_posting();
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
		if (req.status >= 200 && req.status < 400) content_elem.innerHTML = this.responseText;
	};

	req.send();
	enable_posting();
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

about_btn.onclick = getAbout;
classes_btn.onclick = getClasses;
tutor_btn.onclick = getTutoring;
doubts_btn.onclick = getDoubts;
feed_btn.onclick = getFeed;
window.onresize = vert_hor;

vert_hor();
getFeed();



addEventListeners();