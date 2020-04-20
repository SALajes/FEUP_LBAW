function addEventListeners() {
  let postCreator = document.querySelector('div.publish-card form.new_post');
  if(postCreator != null)
    postCreator.addEventListener('submit', sendCreatePostRequest);
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
  let new_post = document.createElement('div');
  new_post.classList.add('card');
  new_post.classList.add('post');
  new_post.classList.add('post-margins');
  new_post.setAttribute('data-id', post.post.id);
  
  new_post.innerHTML = `
    <div class="post-header d-flex justify-content-between">
      <a href="${post.id}"><i class="icon-user post-user"></i>${post.name}</a>
      <a href="#"><i class="icon-ellipsis"></i></a>
    </div>

    <div class="card-body">
      ${post.post.content }
    </div>

    <div class="post-footer">
      <a href="#" class="number-comments">X comments</a>
    </div>
  `;

  return new_post;
}


addEventListeners();