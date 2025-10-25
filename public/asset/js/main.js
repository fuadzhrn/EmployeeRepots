// main.js — UI enhancements for LandingPage
// - create a visible file-picker control for the hidden input#document
// - update file name display
// - smooth-scroll for internal anchors

(function(){
  function initFilePicker(){
    const fileInput = document.getElementById('document');
    if(!fileInput) return;

    // if a file-visual already exists, skip
    const existing = fileInput.closest('.document-supporting')?.querySelector('.file-visual');
    if(existing) return;

    // build visual wrapper
    const wrapper = document.createElement('div');
    wrapper.className = 'file-visual';

    const nameSpan = document.createElement('span');
    nameSpan.className = 'file-name';
    nameSpan.textContent = (fileInput.files && fileInput.files[0]) ? fileInput.files[0].name : 'No file chosen';

    const btn = document.createElement('button');
    btn.type = 'button';
    btn.className = 'file-btn';
    // add small SVG icon inside the button
    btn.innerHTML = '\n      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false">\n        <path d="M12 3v10" stroke="#022033" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>\n        <path d="M8 7l4-4 4 4" stroke="#022033" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>\n        <path d="M21 21H3" stroke="#022033" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>\n      </svg> <span>Choose file</span>';
    btn.addEventListener('click', function(e){
      e.preventDefault();
      fileInput.click();
    });

    const container = fileInput.parentNode;

    // build new wrapper with icon and text
    wrapper.innerHTML = '';
    
    const icon = document.createElement('div');
    icon.className = 'file-upload-icon';
    icon.textContent = '📁';

    const textGroup = document.createElement('div');
    textGroup.className = 'file-upload-text';

    const primaryText = document.createElement('span');
    primaryText.className = 'primary';
    primaryText.textContent = 'Click to upload or drag & drop';

    const secondaryText = document.createElement('span');
    secondaryText.className = 'secondary';
    secondaryText.textContent = 'your file here';

    const fileSize = document.createElement('span');
    fileSize.className = 'file-size';
    fileSize.textContent = 'Maximum file size: 10 MB';

    textGroup.appendChild(primaryText);
    textGroup.appendChild(secondaryText);
    textGroup.appendChild(fileSize);

    nameSpan.textContent = '';

    // drag & drop handlers
    wrapper.addEventListener('dragover', function(e){
      e.preventDefault();
      wrapper.style.borderColor = '#005f5a';
      wrapper.style.background = 'linear-gradient(135deg,rgba(0,126,122,0.12),rgba(0,126,122,0.08))';
    });
    wrapper.addEventListener('dragleave', function(e){
      e.preventDefault();
      wrapper.style.borderColor = '#007E7A';
      wrapper.style.background = 'linear-gradient(135deg,rgba(0,126,122,0.04),rgba(0,126,122,0.02))';
    });
    wrapper.addEventListener('drop', function(e){
      e.preventDefault();
      wrapper.style.borderColor = '#007E7A';
      wrapper.style.background = 'linear-gradient(135deg,rgba(0,126,122,0.04),rgba(0,126,122,0.02))';
      const files = e.dataTransfer.files;
      if(files && files.length > 0){
        fileInput.files = files;
        const event = new Event('change', {bubbles: true});
        fileInput.dispatchEvent(event);
      }
    });

    wrapper.addEventListener('click', function(e){
      e.preventDefault();
      fileInput.click();
    });

    wrapper.appendChild(icon);
    wrapper.appendChild(textGroup);
    wrapper.appendChild(nameSpan);

    // visible error message area
    const errSpan = document.createElement('div');
    errSpan.className = 'file-error-msg';
    errSpan.setAttribute('aria-hidden','true');

    container.appendChild(wrapper);
    // move the input inside wrapper (kept hidden)
    wrapper.appendChild(fileInput);

    // aria-live region for screen readers (or reuse existing #file-status)
    let live = container.querySelector('#file-status');
    if(!live){
      live = document.createElement('div');
      live.id = 'file-status';
      live.className = 'visually-hidden';
      live.setAttribute('role','status');
      live.setAttribute('aria-live','polite');
      container.appendChild(live);
    }

    // update on change with client-side validation (max 10 MB)
    const MAX_BYTES = 10 * 1024 * 1024; // 10 MB
    fileInput.addEventListener('change', function(){
      const f = fileInput.files && fileInput.files[0];
      if(!f){
        nameSpan.textContent = '';
        errSpan.textContent = '';
        live.textContent = '';
        nameSpan.classList.remove('file-error');
        primaryText.textContent = 'Click to upload or drag & drop';
        return;
      }
      if(f.size > MAX_BYTES){
        // too large
        nameSpan.textContent = 'File too large (max 10 MB)';
        errSpan.textContent = 'Selected file is too large. Maximum allowed size is 10 MB.';
        nameSpan.classList.add('file-error');
        primaryText.textContent = '❌ File too large';
        try{ fileInput.value = ''; }catch(e){}
        live.textContent = 'Selected file is too large. Please choose a file smaller than ten megabytes.';
        return;
      }
      // good file
      nameSpan.textContent = '✓ ' + f.name;
      errSpan.textContent = '';
      nameSpan.classList.remove('file-error');
      primaryText.textContent = '✓ File selected';
      live.textContent = 'File selected: ' + f.name;
    });
  }

  function initSmoothScroll(){
    document.querySelectorAll('a[href^="#"]').forEach(function(a){
      a.addEventListener('click', function(e){
        const href = a.getAttribute('href');
        if(!href || href === '#') return;
        const target = document.querySelector(href);
        if(target){
          e.preventDefault();
          target.scrollIntoView({behavior:'smooth', block:'start'});
        }
      });
    });
  }

  document.addEventListener('DOMContentLoaded', function(){
    initFilePicker();
    initSmoothScroll();
  });
})();
