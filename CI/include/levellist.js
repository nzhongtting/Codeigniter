function search_list()
{

    var form = search_action;
    var _URL_ ="/CI/Levellist/index/0/0/0";

    var uri_segment_3   = "0";
    var uri_segment_4   = "0";
    var uri_segment_5   = "0";
    var uri_segment_5_1 = "";

    if( $('#c_name').val() !='' )
    {
        uri_segment_3 = $('#c_name').val() ;
    }

    if( $('#mphone').val() !='' )
    {
        uri_segment_4 = $('#mphone').val() ;
    }

    if( $("#result_type option:selected").val() !='' )
    {
        uri_segment_5 = $("#result_type option:selected").val() ;
    }

    if( $("#g_idx option:selected").val() !='' )
    {
        uri_segment_5_1 = $("#g_idx option:selected").val() ;
        uri_segment_5_1 = "|"+uri_segment_5_1 ;
    }

    _URL_ = "/CI/Levellist/index/"+uri_segment_3+"/"+uri_segment_4+"/"+uri_segment_5+uri_segment_5_1;

    form.action = _URL_ ;
    form.submit();
}

function confirm_result(Z)
{

    $.ajax({cache:false,url: "/CI/Ajax_leveltest/just_get/gettestresult",data: { c_idx : Z  }, success: function(result){

            if( result )
            {
                $( '#levetest_justlist > tbody').html(result);
            }
            else
            {
                $( '#levetest_justlist > tbody').html('<tr><td colspan=3 style="text-align: center"> No Data </td></tr>');
            }

        },
        complete: function ()
        {
            get_leveltest_usere(Z);
        },
        error: function () {   console.log('자료가 없습니다.');    }   });
}

function get_leveltest_usere(Z)
{
    $.ajax({dataType: "json",url: "/CI/Ajax_leveltest/get_user/getuserinfo",data: { c_idx : Z }, success: function(result){

            $.each(result, function (index, item)
            {
                $('#u_name').html(item.c_name);
                $('#c_inday').html(item.date_in);
                $('#c_mphone').html(item.mphone);
                $('#c_level').html(item.result);
            });
        }, error: function () {   alert('회원정보가 없습니다');    }   });
}

function temporary_crud(Z)
{

        $.ajax({cache:false,url: "/CI/Ajax_leveltest/get_tempry/gettemporarylist",data: { c_idx : Z  }, success: function(result)
        {
        },
        complete: function ()
        {
            location.reload();
        },
        error: function () {   console.log('자료가 없습니다.');    }   });

}