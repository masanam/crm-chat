 'use strict';

 document.addEventListener('DOMContentLoaded', function () {
   (async function () {
    const fullToolbar = [
      [
        {
          size: []
        }
      ],
      ['bold', 'italic', 'underline'],
      [
        {
          list: 'ordered'
        },
        {
          list: 'bullet'
        },
      ],
      [
        {
          align: []
        }
      ],
      ['link', 'image', 'video'],
      ['clean']
    ];
    
    /**
    * @description text editor for modal reply email
    */
    const editor = document.querySelector('#full-editor-reply-email');
    if (editor) {
      new Quill(editor, {
        bounds: editor,
        placeholder: 'Write a note... ',
        modules: {
          toolbar: fullToolbar
        },
        theme: 'snow'
      });
    }

    /**
      * @description set scrollable sidebar client
      */
    const sidebarClient = document.querySelector('.sidebar-customer-info');
      if (sidebarClient) {
      new PerfectScrollbar(sidebarClient, {
        wheelPropagation: false,
        suppressScrollX: true
      });
    }
   })();
 });
 