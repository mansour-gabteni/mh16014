{*
*  @author Evgeny Grishin <e.v.grishin@yandex.ru>
*  @copyright  2015 Evgeny grishin
*}
{strip}
{addJsDef egcallme_ajaxcontroller=$ajaxcontroller}
{if $mask!=''}
{addJsDef egcallme_mask=$mask}
{/if}	
{/strip}
{if $btn_view=='Link'}
<div class="clearfix pull-left ddd" style="text-align: center;">
{if $phone!=''}
<div class="phone">{$phone|escape:'html':'UTF-8'}</div>
{/if}
<div><a class="eg_callme_btn callme" href="#" rel="#">{l s='call me order' mod='egcallme'}</a></div>
</div>
{/if}
{if $btn_view=='Button'}
<div class="clearfix pull-left">
	<button class="eg_callme_btn" type="button">{l s='call me order' mod='egcallme'}</button>
</div>
{/if}
{if $btn_view=='Self'}
{*$btn_self|escape:'quotes':'UTF-8'*}
{/if}
{if $phone_tube=='Show' or  $phone_tube=='Animation'}
{if $phone_tube=='Animation'}
<style type="text/css">
    @keyframes cbh-circle-anim {
        0% {
            transform: scale(1);
            -webkit-transform: scale(1);
            -moz-transform: scale(1);
            -o-transform: scale(1);
            -ms-transform: scale(1);
        }
        40% {
            -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=90)";
            opacity: 0.9;
            transform: scale(1.2);
            -webkit-transform: scale(1.2);
            -moz-transform: scale(1.2);
            -o-transform: scale(1.2);
            -ms-transform: scale(1.2);
        }
        100% {
            transform: scale(1.5);
            -webkit-transform: scale(1.5);
            -moz-transform: scale(1.5);
            -o-transform: scale(1.5);
            -ms-transform: scale(1.5);
        }
    }

    @keyframes cbh-circle-fill-anim {
        0%, 100% {
            transform: scale(1.5);
            -webkit-transform: scale(1.5);
            -moz-transform: scale(1.5);
            -o-transform: scale(1.5);
            -ms-transform: scale(1.5);
        }
        40% {
            transform: scale(1);
            -webkit-transform: scale(1);
            -moz-transform: scale(1);
            -o-transform: scale(1);
            -ms-transform: scale(1);
        }
    }

    @keyframes cbh-circle-img-anim {
        0%, 50%, 100% {
            transform: rotate(0deg);
            -webkit-transform: rotate(0deg);
            -moz-transform: rotate(0deg);
            -o-transform: rotate(0deg);
            -ms-transform: rotate(0deg);
        }
        10%, 30% {
            transform: rotate(-25deg);
            -webkit-transform: rotate(-25deg);
            -moz-transform: rotate(-25deg);
            -o-transform: rotate(-25deg);
            -ms-transform: rotate(-25deg);
        }
        20%, 40% {
            transform: rotate(25deg);
            -webkit-transform: rotate(25deg);
            -moz-transform: rotate(25deg);
            -o-transform: rotate(25deg);
            -ms-transform: rotate(25deg);
        }
    }

    @-webkit-keyframes cbh-circle-anim {
        0% {
            transform: scale(1);
            -webkit-transform: scale(1);
            -moz-transform: scale(1);
            -o-transform: scale(1);
            -ms-transform: scale(1);
        }
        40% {
            -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=90)";
            opacity: 0.9;
            transform: scale(1.2);
            -webkit-transform: scale(1.2);
            -moz-transform: scale(1.2);
            -o-transform: scale(1.2);
            -ms-transform: scale(1.2);
        }
        100% {
            transform: scale(1.5);
            -webkit-transform: scale(1.5);
            -moz-transform: scale(1.5);
            -o-transform: scale(1.5);
            -ms-transform: scale(1.5);
        }
    }

    @-webkit-keyframes cbh-circle-fill-anim {
        0%, 100% {
            transform: scale(1.5);
            -webkit-transform: scale(1.5);
            -moz-transform: scale(1.5);
            -o-transform: scale(1.5);
            -ms-transform: scale(1.5);
        }
        40% {
            transform: scale(1);
            -webkit-transform: scale(1);
            -moz-transform: scale(1);
            -o-transform: scale(1);
            -ms-transform: scale(1);
        }
    }

    @-webkit-keyframes cbh-circle-img-anim {
        0%, 50%, 100% {
            transform: rotate(0deg);
            -webkit-transform: rotate(0deg);
            -moz-transform: rotate(0deg);
            -o-transform: rotate(0deg);
            -ms-transform: rotate(0deg);
        }
        10%, 30% {
            transform: rotate(-25deg);
            -webkit-transform: rotate(-25deg);
            -moz-transform: rotate(-25deg);
            -o-transform: rotate(-25deg);
            -ms-transform: rotate(-25deg);
        }
        20%, 40% {
            transform: rotate(25deg);
            -webkit-transform: rotate(25deg);
            -moz-transform: rotate(25deg);
            -o-transform: rotate(25deg);
            -ms-transform: rotate(25deg);
        }
    }

    @-moz-keyframes cbh-circle-anim {
        0% {
            transform: scale(1);
            -webkit-transform: scale(1);
            -moz-transform: scale(1);
            -o-transform: scale(1);
            -ms-transform: scale(1);
        }
        40% {
            -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=90)";
            opacity: 0.9;
            transform: scale(1.2);
            -webkit-transform: scale(1.2);
            -moz-transform: scale(1.2);
            -o-transform: scale(1.2);
            -ms-transform: scale(1.2);
        }
        100% {
            transform: scale(1.5);
            -webkit-transform: scale(1.5);
            -moz-transform: scale(1.5);
            -o-transform: scale(1.5);
            -ms-transform: scale(1.5);
        }
    }

    @-moz-keyframes cbh-circle-fill-anim {
        0%, 100% {
            transform: scale(1.5);
            -webkit-transform: scale(1.5);
            -moz-transform: scale(1.5);
            -o-transform: scale(1.5);
            -ms-transform: scale(1.5);
        }
        40% {
            transform: scale(1);
            -webkit-transform: scale(1);
            -moz-transform: scale(1);
            -o-transform: scale(1);
        }
    }

    @-moz-keyframes cbh-circle-img-anim {
        0%, 50%, 100% {
            transform: rotate(0deg);
            -webkit-transform: rotate(0deg);
            -moz-transform: rotate(0deg);
            -o-transform: rotate(0deg);
            -ms-transform: rotate(0deg);
        }
        10%, 30% {
            transform: rotate(-25deg);
            -webkit-transform: rotate(-25deg);
            -moz-transform: rotate(-25deg);
            -o-transform: rotate(-25deg);
            -ms-transform: rotate(-25deg);
        }
        20%, 40% {
            transform: rotate(25deg);
            -webkit-transform: rotate(25deg);
            -moz-transform: rotate(25deg);
            -o-transform: rotate(25deg);
            -ms-transform: rotate(25deg);
        }
    }
</style>
{/if}
<div class="eg_callme_btn pozvonim-button BOTTOM_RIGHT pozvonim-button-animation" style="position: fixed; bottom: 30px;right: 50px;z-index: 999;; cursor: pointer; opacity: 1; display: block;">
    <div class="pozvonim-button-wrapper actionShow">    
        <div class="pozvonim-button-border-inner"></div>
        <div class="pozvonim-button-border-outer"></div>
        <div class="pozvonim-button-text">
            <span class="pozvonim-button-center-text">{l s='Free callback' mod='egcallme'}</span>
        </div>
        <div class="pozvonim-button-phone"></div>
    </div>
</div>
{/if}