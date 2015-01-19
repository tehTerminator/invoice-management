$(document).ready(function(){
	autoload(['copier|10|posted_on.DESC', 'accounts']);
	executeTasks( global.tasks );
	executeTasks( [initDynamicTables] );
});

$("#addCopierForm").find(".submit.button").on('click', function(){
	load("copier|10|posted_on.DESC");
	clearTable("recentCopier");
	jQuery("#recentCopier").fillTable();
});

