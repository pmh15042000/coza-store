// input ngăn chạn file .exe ... ở frontend
    $('INPUT[type="file"]').change(function () {
        var ext = this.value.match(/\.(.+)$/)[1];
        switch (ext) {
            case 'jpg':
            case 'JPG':
            case 'jpeg':
            case 'JPEG':
            case 'png':
            case 'PNG':
            case 'gif':
            case 'GIF':
                break;
            default:
                alert('This is not an allowed file type.');
                this.value = '';
        }
        // if(this.value != ''){
        //     const form= new FormData();
        //     form.append('file',$(this)[0].files[0]);
        //     $.ajax({
        //         processData: false,
        //         contentType: false,
        //         type: 'POST',
        //         datatype: 'JSON',
        //         data: form,
        //         url: '/admin/upload/services',
        //         success: function(results){
        //             if(results.error == true){
        //                 alert("Upload file error!!");
        //             }else{
        //                 $('#thumb_show').html('<a href="/public/storage/images/products/80/'+ results.url +'" target="_blank">'+'<img src="/public/storage/images/products/80/'+ results.url +'">'+'</a>');
        //                 $('#thumb').val(results.url);
        //             }
        //         }
        //     })
        // }
    });
$("#check_thumb").click(function(e){
    e.preventDefault();
    const thumb= $("#upload_thumb").val();
    if(thumb != ''){
        const form= new FormData();
        form.append('file',$('#upload_thumb')[0].files[0]);
        $.ajax({
            processData: false,
            contentType: false,
            type: 'POST',
            datatype: 'JSON',
            data: form,
            url: '/admin/upload/services',
            success: function(results){
                if(results.error == true){
                    alert("Upload file error!!");
                }else{
                    $('#thumb_show').html('<a href="/public/storage/images/products/80/'+ results.url +'" target="_blank">'+'<img src="/public/storage/images/products/80/'+ results.url +'">'+'</a>');
                    $('#thumb').val(results.url);
                }
            }
        })
    }else{
        alert('Chưa có ảnh nào!');
    }
    
});
$("#check_thumb_menu").click(function(e){
    e.preventDefault();
    const thumb= $("#upload_thumb").val();
    if(thumb != ''){
        const form= new FormData();
        form.append('file',$('#upload_thumb')[0].files[0]);
        $.ajax({
            processData: false,
            contentType: false,
            type: 'POST',
            datatype: 'JSON',
            data: form,
            url: '/admin/upload/services-menu',
            success: function(results){
                if(results.error == true){
                    alert("Upload file error!!");
                }else{
                    $('#thumb_show').html('<a href="/public/storage/images/menus/80/'+ results.url +'" target="_blank">'+'<img src="/public/storage/images/menus/80/'+ results.url +'">'+'</a>');
                    $('#thumb').val(results.url);
                }
            }
        })
    }else{
        alert('Chưa có ảnh nào!');
    }
    
});
$("#check_slider").click(function(e){
    e.preventDefault();
    const thumb= $("#upload_thumb").val();
    if(thumb != ''){
        const form= new FormData();
        form.append('file',$('#upload_thumb')[0].files[0]);
        $.ajax({
            processData: false,
            contentType: false,
            type: 'POST',
            datatype: 'JSON',
            data: form,
            url: '/admin/upload/services-slider',
            success: function(results){
                if(results.error == true){
                    alert("Upload file error!!");
                }else{
                    $('#thumb_show').html('<a href="/public/storage/images/sliders/80/'+ results.url +'" target="_blank">'+'<img src="/public/storage/images/sliders/80/'+ results.url +'">'+'</a>');
                    $('#thumb').val(results.url);
                }
            }
        })
    }else{
        alert('Chưa có ảnh nào!');
    }
    
});
$('#check_sub_img').click(function(e){
    e.preventDefault();
    const sub_thumb= $("#sub_thumbs").val();
    if(sub_thumb != ''){
        const form= new FormData();
        const ins= $('#sub_thumbs')[0].files.length;
        for(var x=0; x< ins ; x++){
            form.append('files[]',$('#sub_thumbs')[0].files[x]);
        }
        $.ajax({
            processData: false,
            contentType: false,
            type: 'POST',
            datatype: 'JSON',
            data: form,
            url: '/admin/upload/services',
            success: function(results){
                if(results.error == true){
                    alert("Upload file error!!");
                }else{
                    const data= jQuery.parseJSON(results.url);
                    var html = '';
                    $.each(data, function(key,value){
                        html +='<a href="/public/storage/images/products/150/'+ value +'" target="_blank">'+'<img src="/public/storage/images/products/150/'+ value +'">'+'</a>';
                    });
                    $('#sub_thumb_show').html(html);
                    $('#sub_img').val(results.url);
                }
            }
        })
    }else{
        alert('Không có ảnh nàooooo hihi');
    }
});
// ajax load sub category{menu}
$("#category-dropdown").on('change',function(){
    var cat_id= $(this).val();
    $.ajax({
        url : '/admin/get-sub',
        data: {id:cat_id},
        success: function(data)
        {
            if(data.length>0)
                {
                    var html= '<option value="">Chọn thương hiệu</option>';
                    for(var count=0; count< data.length;count++){
                        html += '<option value="'+data[count].id+'">'+data[count].name+'</option>'   
                    }
               };
               $("#sub-category-dropdown").html(html);
        }    
    });
});


$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function removeRow(id,url){
    if(confirm('Xóa danh mục này và danh mục con của danh mục này. Bạn có muốn tiếp tục?')){
        $.ajax({
            type: 'delete',
            datatype: 'JSON',
            data: {id:id},
            url: url,
            success:function(result){
                if(result.error == false){
                    alert(result.message)
                    location.reload();
                }else{
                    alert('Xoá thất bại vui lòng thử lại');
                }

            }
            
        })
    }
}
// upload file
