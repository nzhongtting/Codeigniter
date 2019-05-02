function search_list()
{

    var form = search_action;
    var _URL_ ="/CI/Levellist/index/0/0/0";

    var uri_segment_3   = "0";
    var uri_segment_4   = "0";
    var uri_segment_5   = "0";
    var uri_segment_5_1 = "";
    var uri_segment_5_2 = "";

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

    if( $("#chk_pc_m option:selected").val() !='' )
    {
        uri_segment_5_2 = $("#chk_pc_m option:selected").val() ;
        if( uri_segment_5_1 )
        {
            uri_segment_5_2 = "|"+uri_segment_5_2 ;
        }
        else
        {
            uri_segment_5_2 = "||"+uri_segment_5_2 ;
        }

    }

    _URL_ = "/CI/Levellist/index/"+uri_segment_3+"/"+uri_segment_4+"/"+uri_segment_5+uri_segment_5_1+uri_segment_5_2;

    form.action = _URL_ ;
    form.submit();
}

function confirm_result(Z)
{

    $.ajax({cache:false,url: "/CI/Ajax_leveltest/just_get/gettestresult",data: { c_idx : Z  }, success: function(result){

            if( result )
            {
                $('#levetest_justlist > tbody').html(result);
            }
            else
            {
                $( '#levetest_justlist > tbody').html('<tr><td colspan=3 style="text-align: center"> No Data </td></tr>');
            }

        },
        complete: function ()
        {
            get_leveltest_usere(Z,'1');
        },
        error: function () {   console.log('자료가 없습니다.');    }   });
}

function get_leveltest_usere(Z,N)
{
    $.ajax({dataType: "json",url: "/CI/Ajax_leveltest/get_user/getuserinfo",data: { c_idx : Z }, success: function(result){

            $.each(result, function (index, item)
            {
                if( N == 1 )
                {
                    $('#u_name1').html(item.c_name);
                    $('#c_inday1').html(item.date_in);
                    $('#c_mphone1').html(item.mphone);
                    $('#c_level1').html(item.result);
                }
                else if( N == 2 )
                {
                    $('#u_name2').html(item.c_name);
                    $('#c_inday2').html(item.date_in);
                    $('#c_mphone2').html(item.mphone);
                    $('#c_level2').html(item.result);
                }

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

function result_del(Z)
{
    ans = confirm("정말 삭제하시겠습니까 ?");
    if( ans == true )
    {
        $.ajax({cache:false,url: "/CI/Ajax_leveltest/set_result/afterdelresult",data: { c_idx : Z  }, success: function(result)
            {
            },
            complete: function ()
            {
                location.reload();
            },
            error: function () {   console.log('자료가 없습니다.');    }   });
    }
}

function memo_action(Z)
{
    if($("#memo_w.collapsed-box").length)
    {
        $('#memobtn').trigger("click");
    }

    $('#selected_c_idx').val(Z);

    $.ajax({cache:false,url: "/CI/Ajax_leveltest/get_memo_list/memolist",data: { c_idx : Z  },

        success: function (result) {
            $('#memo_justlist > tbody').html(result);
        },
        complete: function ()
        {
            // location.reload();
        },
        error: function () {   console.log('자료가 없습니다.');    }   });

}

function get_memo(Z,Y)
{

    $.ajax({cache:false,url: "/CI/Ajax_leveltest/get_memo/memoinfo",data: { m_idx : Z  },

        success: function (result) {

            if( result )
            {
                $( '#memo_body > tbody').html(result);
            }
            else
            {
                $( '#memo_body > tbody').html('<tr><td colspan=2 style="text-align: center"> <br><br>No Data </td></tr>');
            }
        },
        complete: function ()
        {
            get_leveltest_usere(Y,'2');
        },
        error: function () {   console.log('자료가 없습니다.');    }   });

}

function delmemo(Z,Y)
{

    ans = confirm("정말 삭제하시겠습니까?");
    if( ans == true )
    {
        $.ajax({
            cache: false, url: "/CI/Ajax_leveltest/del_memo", data: {m_idx: Z},

            success: function (result) {
            },
            complete: function () {
                memo_action(Y);
            },
            error: function () {
                console.log('자료가 없습니다.');
            }
        });
    }
}


function memo_submit()
{
    var scidx =  $('#selected_c_idx').val();


    if( scidx !='' )
    {

        if( $('#memobody').val() !='')
        {
            var form=$('#upload_action');
            ans = confirm("메모를 등록하시겠습니까?");
            if( ans == true )
            {
                $.ajax({
                    cache: false,
                    type: 'POST',
                    url: '/CI/Ajax_leveltest/memo_save',
                    data: form.serialize(),
                    error: function () {
                        $('#result_div').html('<p>An error has occurred</p>');
                    },
                    success: function (response) {
                        // $("#etc_msg").val(response);
                    },
                    complete: function () {
                        $('#memobody').val("");
                        memo_action(scidx);
                    }
                });
            }
        }
        else
        {
            alert('메모를 입력하세요');
        }

    }
    else
    {
        alert('등록할 레벨테스트 결과의 "메모"버튼을 선택하세요');
    }


}
