(function ($) {
    jQuery.fn.UTDragDrop = function(options){
        var DefaultOptions = {
            revision:'',
            //server upload url
            url              : '',
            // do upload immediatelly
            load_immediately : true,
            // allow multiupload
            multi_upload     : false,
            //executes on success file upload
            success_callback : function(){$('.dropfile').attr('disabled', false); console.log('successfully updated')},
            //executes on fail file upload
            error_callback   : function(){$('.dropfile').attr('disabled', false); console.log('server error')},
            //executes before file upload
            before_callback : function(){console.log('successfully updated')},
            //label for D&D div
            label            : 'Drop your binary here or click to select a file',
            //name of input field(s)
            file_name        : 'user_file[]',
            image_logo_url   : '/assets/default_logo.png'
        };

        var _FILE;

        var options = $.extend(DefaultOptions,options);
        var dropbox = this;
        var XHR;
        var _readers = [];


        var init = function(){
            if(options.revision){
                dropbox.html('<div class="dropbox-container-revision"><img src="'+options.image_logo_url+'" id="dropicon"/><input type="file" class="dropfile" '+(options.accept_files ? 'accept="'+options.accept_files+'"' : '')+'/><span id="droplabel" class="droplabel">'+options.label+'</span><img src="/assets/upload_progress.gif" class="upload_progress_image"/><div id="progress" class="progress"><div class="progress-bar progress-bar-success"></div></div><div class="revision_info"><span>!</span>Only apps with integrated Ubertesters SDK are allowed</div></div>');
            }else {
                dropbox.html('<img src="'+options.image_logo_url+'" id="dropicon"/><input type="file" class="dropfile" '+(options.accept_files ? 'accept="'+options.accept_files+'"' : '')+'/><span id="droplabel" class="droplabel">'+options.label+'</span><img src="/assets/upload_progress.gif" class="upload_progress_image"/><div id="progress" class="progress"><div class="progress-bar progress-bar-success"></div></div>');
                dropbox.addClass('dropbox-container');
            }
            var upload_content ='<div id="progress-bar"><div id="progress-line"></div></div>';
//                '<div class="upload_progress"><div><span class="upload_label">Wait while processing </span><span class="upload_file_name"></span><br/><div id="progress-bar"><div id="progress-line"></div></div><br/><ul class="uploaded_files"></ul><a class="btn btn-large btn-warning progress-cancel">Cancel</a></div></div>'

//            dropbox.append(upload_content);


            var target = dropbox.get(0);
            if (target.addEventListener) {  // all browsers except IE before version 9
                // Firefox, Google Chrome, Safari, Internet Exlorer
                target.addEventListener("dragenter", dragEnter, false);
                target.addEventListener("dragexit", dragExit, false);
                target.addEventListener("dragover", dragOver, false);
                target.addEventListener("drop", drop, false);

            }
            else {
                if (target.attachEvent) {   // IE before version 9
                    target.attachEvent ("ondragenter", dragEnter);
                    target.attachEvent ("ondragleave", dragExit);
                }
            }




            dropbox.find('input.dropfile').on('change',function(e){
                var file = $(this).get(0).files[0];
                if (file){
                    $('.upload_progress_image').show();
                    $('.droplabel').text('Wait while processing');
                    handleFiles([file]);
                }
            });
            $('.progress-cancel').off('click').on('click',function(e){
                e.preventDefault();
                XHR.abort();
                $('.upload_progress_image').hide(500);
                $('.dropfile').val('');
                $('.droplabel').val(options.label);

                return false;
            });

            function shipOff(event) {
                var result = event.target.result;
                var data = new FormData();
                data.append('file-0',_FILE);
                $(".upload_file_name").text('"'+_FILE.name+'"');
                XHR = $.ajax({
                    url: options.url,  //server script to process data
                    type: 'POST',
                    xhr: function() {  // custom xhr
                        myXhr = $.ajaxSettings.xhr();
                        if(myXhr.upload){ // check if upload property exists
                            myXhr.upload.addEventListener('progress',handleUploaderProgress, false); // for handling the progress of the upload
                        }
                        return myXhr;
                    },
                    //Ajax events
                    beforeSend: function(e){
                        if($.isFunction(options.before_callback)){
                            options.before_callback(e);
                        }
                    },
                    success:  function(e){
                        $('.progress').hide();
                        $('.droplabel').val(options.label);
                        $('.uploaded_files').append('<li class="success">'+_FILE.name+'</li>');
                        $('.upload_file_name').text('');
                        $('.upload_progress').hide(100);
                        $('.droplabel').text(options.label);
                        $('.dropfile').attr('disabled', false);
                        if($.isFunction(options.success_callback)){
                            options.success_callback(e);
                        }
                        $('.upload_progress_image').hide();
                    },
                    error:  function(e){
                        $('.progress').hide();
                        $('.droplabel').val(options.label);
                        $('.uploaded_files').append('<li class="error">'+_FILE.name+'</li>');
                        $('.dropfile').attr('disabled', false);
                        if($.isFunction(options.error_callback)){
                            options.error_callback();
                        }
                        $('.upload_progress_image').hide();
                    },
                    // Form data
                    data: data,
                    cache: false,
                    contentType: false,
                    processData: false
                });
                window._XHR = XHR;
            }

            function successUploaded(evt) {
                $("#progressbar").progressbar({ value: 100 });
            }




            function drop(evt) {
                    $('#error_message').css('display', 'none');
                    $('.dropfile').attr('disabled', true);
                    $('.droplabel').text('Wait while processing');
                    $('.upload_progress_image').show();
                    $('#progress-line').css('width',0);
                    evt.stopPropagation();
                    evt.preventDefault();
                    var files = evt.dataTransfer.files;
                    var count = files.length;

                    // Only call the handler if 1 or more files was dropped.
                    if (count > 0){
                        handleFiles(files);
                    }

            }

            function handleFiles(files) {
                $('#error_message').css('display', 'none');
                $('.dropfile').attr('disabled', true);
                console.log('Start handle files');
                var l = files.length;
                $('.uploaded_files').html('');
                $('.upload_progress_image').show(100);

                for(var i = 0;i<l;i++){
                    if (!options.multi_upload && i > 0){
                        break;
                    }
                    _FILE = files[i];
                    var reader = new FileReader();
                    reader.onprogress = handleReaderProgress;
                    reader.readAsDataURL(files[i]);
                    reader.onloadend = handleReaderLoadEnd;
                    reader.onload = shipOff;
                    console.log(reader)
                    console.log(files)
                }
            }

            function handleReaderLoadEnd(evt) {
                $("#progressbar").progressbar({ value: 100 });
            }

            function handleReaderProgress(evt) {
//                console.log('handle reader progress');
                if (evt.lengthComputable) {
                    var loaded = (evt.loaded / evt.total);
                    console.log( evt.loaded , evt.total );

                }
            }
            function handleUploaderProgress(evt) {
                $('.upload_progress_image').hide();
                $('.progress').show();
                var p = evt.loaded / evt.total;
//                console.log(p)
                if (p && p>0){
                    p = (p*100)+'%';
                    console.log(p);
                    $('.progress-bar-success').css('width',p);
                    if(p>='98'){
                        $('.progress').hide();
                        $('.upload_progress_image').show();
                    }
                }
            }

            function dragEnter(evt) {
                evt.stopPropagation();
                markBox($(dropbox));
                evt.preventDefault();
            }

            function dragExit(evt) {
                unmarkBox($(dropbox))
                evt.stopPropagation();
                evt.preventDefault();
            }

            function dragOver(evt) {
                evt.stopPropagation();
                markBox($(dropbox))
                evt.preventDefault();
            }

            function markBox(box) {
            }
            function unmarkBox(box) {
            }
        };

        initSimple = function(){
            if(options.revision){
                dropbox.html('<div class="ie-dropbox-container-revision"><img style="width:72px; height:72px;" id="dropicon" src="'+options.image_logo_url+'" id="dropicon"/><span class="btn btn-warning fileinput-button">'+
                    '<span>Click to load</span><input type="file" id="fileupload" name="files[]" data-url="'+options.url+'"'+(options.accept_files ? 'accept="'+options.accept_files+'"' : '')+'/></span><img src="/assets/upload_progress.gif" class="upload_progress_image"/><div class="revision_info"><span>!</span>Only apps with integrated Ubertesters SDK are allowed</div></div>');
            }else {
            dropbox.html('<div class="ie-loader-container"><img style="width:72px; height:72px; margin-left:70px;" id="dropicon" src="'+options.image_logo_url+'" id="dropicon"/><span class="btn fileinput-button">'+
                '<span>Click to load</span><input type="file" id="fileupload" name="files[]" data-url="'+options.url+'"'+(options.accept_files ? 'accept="'+options.accept_files+'"' : '')+'/></span><img src="/assets/upload_progress.gif" class="upload_progress_image"/></div>');
            }
                $('#fileupload').fileupload({
                dataType: 'html',
                success: function (data) {
                    options.success_callback(data);
                    $('.upload_progress_image').fadeOut();
                    $('#fileupload').attr('disabled', false);
                    $('.fileinput-button').removeClass('disabled');
                },
                error: function () {
                    options.error_callback();
                    $('.upload_progress_image').fadeOut();
                    $('#fileupload').attr('disabled', false);
                    $('.fileinput-button').removeClass('disabled');
                },

                add: function (e, data) {
                    $('.upload_progress_image').fadeIn();
                    $('#fileupload').attr('disabled', true);
                    $('.fileinput-button').addClass('disabled');
                    data.submit();
                }
            });
        };
        if($('html').is('.ie')){
            initSimple();
        }else{
            init();
        }

    };
})(jQuery);
