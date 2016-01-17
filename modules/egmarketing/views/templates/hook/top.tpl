{strip}
{addJsDef egmarketing_ajaxcontroller=$ajaxcontroller}
{/strip}
{if $city=='show'}
<script type="text/javascript">
$( window ).load(function(){
	cityQuestion();
});
</script>
{/if}