window.facebookGraph = (function(){ 

	var instance;
	function init(){
		return{
			albums:[],
			albums_sel : [],
			getAlbumsByProfile:function(profile){
				$.getJSON('http://graph.facebook.com/'+profile+'/albums',function(response){
					$.each(response.data,function(index,item, array){
						instance.albums.push(item);
					});
				});
			},
			getAlbumsByYear: function(year){
				$.each(instance.albums,function(index,item, array){
					if(year==item.created_time.split('-')[0]
						&& instance.albums_sel.indexOf(item) == -1){
						instance.albums_sel.push(item);
				}
			});
			},
			displayPhotos:function(){
				var divPic = document.getElementById("content");
				divPic.innerHTML = "";
				var html = "";
				$.each(instance.albums_sel,function(indexSel,itemSel,arraySel){
					$.getJSON('http://graph.facebook.com/'+itemSel.id+'/photos',
						function(response){
							$.each(response.data, function(index, item, array){
								html+="<div class='picture'><img src='"+item.picture+"' /></div>";
							});
							divPic.innerHTML += html;
					});
				});
			},
			removeAlbumByYear:function(year){
				var temp = [];
				$.each(instance.albums_sel, function(index,item, array){
					if(year != item.created_time.split('-')[0]){
						temp.push(item);
					}
				});
				instance.albums_sel = temp;
			},
			createSelectByExistedYears : function(){
				var select = document.getElementById("my-select");
				var temp =[];
				$.each(instance.albums, function(index, item, array){
					if(temp.indexOf(item.created_time.split("-")[0])==-1){
						temp.push(item.created_time.split("-")[0]);
						var option = document.createElement("option");
						option.text = item.created_time.split("-")[0];
						option.value = item.created_time.split("-")[0];
						try {
							//versiones anteriores IE8
							select.add(option,select.options[null]);
						} catch (e) {
							select.add(option,null);
						}
					}
				});
			}
		}
	};
	return{
		getInstance : function(){
			if(!instance){
				instance = init();
			}
			return instance;
		}
	};
})();

