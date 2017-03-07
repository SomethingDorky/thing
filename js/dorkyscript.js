$(document).ready(function() { //Add Thing To Favorites from Heart Icon
    
    $(document).on('mouseover mouseout', '.non_favs li', function() {
        $('.add', this).toggleClass('favorite');
    });
    
    $requestRunning = false;
    $(document).on('click', '.non_favs .add', function() {
        if ($requestRunning) {
            return; // Don't do anything if an AJAX request is running
        }
        
        $this = $(this);
        $this_li = $this.closest('li');
        $id = $this_li.attr('id').split("_");
        $id = $id[1];
        $name = $this.siblings('h3').text();
        $description =$this.siblings('.description').text();
        
        $.ajax({
            url: "ajax/add.favs.ajax.php",
            type: "POST",
            data: {
                'dork_id' : $dorkID,
                'thing_id' : $id
            }, // End data
            'beforeSend': function(){
                $requestRunning = true;
                $this_li.remove();
                $('.highlight').removeClass('highlight');
                $('.loader_large').removeClass('hidden');
                $('html').not('.loader_large').addClass('dim');
            }, // End beforeSend
            'success': function() {
                $requestRunning = false;
                
                $name = $name.replace(/'/g,"&apos;"); 
                $description = $description.replace(/'/g,"&apos;"); 
                
                $output = "<li title='" + $description + "' id='fav_" + $id + "'>";
                $output += "<a href='index.php?dork=" + $dorkID + "&amp;thing=" + $id + "'>" + $name + "</a>";
                $output += "</li>";
                
                $("ul.favs").append($output);
                
                $(".favs li#fav_" + $id).draggable({
                   helper: 'clone'            
                });
                
                $this_added = $('li#fav_' + $id);
                $this_added.addClass('highlight');
                $('.loader_large').addClass('hidden');
                $('html').not('.loader_large').removeClass('dim');
                
                $('.favs li').mouseover(function() {
                    $('.highlight').removeClass('highlight');
                });
                
                tinysort('.favs li');
                
                $('p.welcome').text("").removeClass('like_all like_none no_border_bottom').addClass('like_some');
                $('.trash, .favs, .non_favs').removeClass('hidden');
                $('.favs_list h2').text("Favorite Things");
                
                if ($('.favs li').length===0) {
                    $('p.welcome').text("").removeClass('like_some').addClass('like_none');
                    $('.trash, .favs').addClass('hidden');
                    $('.favs_list h2').text("No Favorite Things");
                    $('.non_favs').removeClass('hidden');
                }
                
                if ($('.non_favs li').length===0) {
                    $('p.welcome').text("").removeClass('like_some').addClass('like_all no_border_bottom');
                    $('.trash, .favs').removeClass('hidden');
                    $('.favs_list h2').text("Favorite Things");
                    $('.non_favs').addClass('hidden');
                }
                
            } // End success
        }); // End AJAX
        
    }); // End movie_list click function
}); // End document ready

$(document).ready(function() { // Drag & Drop Remove From Favorites
                  
    $('.favs li').draggable({
        helper: 'clone',
        drag: function() {
            $('.trash').addClass('trash_hover');
        } // End drag function 
    }); // End draggable

    $('.trash').droppable({
        accept: '.favs li', 
        drop: function(event, ui) {
            $this = $(ui.draggable);
            $id = $this.attr('id').split("_");
            $id = $id[1];            
            $name = $(ui.draggable).text();
            $description = $this.attr('title');
            
            $.ajax({
                url: "ajax/remove.favs.ajax.php",
                type: "POST",
                data: {
                    'dork_id' : $dorkID,
                    'thing_id' : $id
                }, // End data
                'beforeSend': function() {
                    $this.remove();
                    $('trash').addClass('trash_hover');
                    $('.success').removeClass('success');
                    $('.loader_large').removeClass('hidden');
                    $('html').not('.loader_large').addClass('dim');
                }, // End beforeSend
                'success': function() {
                    $name = $name.replace(/'/g,"&apos;"); 
                    $description = $description.replace(/'/g,"&apos;");
                    
                    $output = "<li id='nonfav_" + $id + "'>";
                    $output += "<figure>";
                    $output += "<a href='index.php?dork=" + $dorkID + "&amp;thing=" + $id + "'>";
                    $output += "<img class='thumbnail' alt='" + $name + "' src='images/dorkypics/dork" + $id + ".jpg' onerror=this.src='images/dorky_thumb.png'>";
                    $output += "</a>";
                    $output += "<figcaption>";
                    $output += "<h3><a href='index.php?dork=" + $dorkID + "&amp;thing=" + $id + "'>" + $name + "</a></h3>";
                    $output += "<div class='description'><p>" + $description + "</p></div>";
                    $output += "<div class='add'></div>";
                    $output += "</figcaption>";
                    $output += "</figure>";
                    $output += "</li>";
                    
                    
                    $("ul.non_favs").prepend($output);
                    
                    $this_added = $('li#nonfav_' + $id + ' .add');
                    $this_added.removeClass('favorite').addClass('add success');
                    $('.loader_large').addClass('hidden');
                    $('html').not('.loader_large').removeClass('dim');
                    
                    $('.non_favs li').mouseover(function() {
                       $('.success').removeClass('success'); 
                    });
                    
                    $('trash').removeClass('trash_hover');
                    
                    $('p.welcome').text("").removeClass('like_all like_none no_border_bottom').addClass('like_some');
                    $('.trash, .favs, .non_favs').removeClass('hidden');
                    $('.favs_list h2').text("Favorite Things");
                    
                    if ($('.favs li').length===0) {
                        $('p.welcome').text("").removeClass('like_some').addClass('like_none');
                        $('.trash, .favs').addClass('hidden');
                        $('.favs_list h2').text("No Favorite Things");
                        $('.non_favs').removeClass('hidden');
                    }
                    
                    if ($('.non_favs li').length===0) {
                        $('p.welcome').text("").removeClass('like_some').addClass('like_all no_border_bottom');
                        $('.trash, .favs').removeClass('hidden');
                        $('.favs_list h2').text("Favorite Things");
                        $('.non_favs').addClass('hidden');
                    }
                } // End success
            });  // End AJAX
                          
           
        } // End drop function
    }); // End droppable
    
}); // End document ready

$(document).ready(function() { // Add To Favorites From Single Thing Page
    
    $requestRunning = false;
    $(document).on('click', '.actions .add', function() {
        if ($requestRunning) {
            return; // Don't do anything if an AJAX request is running
        }
        
        $this = $(this);
        $id = $this.attr('id').split("_");
        $id = $id[1];
        $name = $('h3.name').text();
        $description =$this.siblings('p.description').text();
        
        $.ajax({
            url: "ajax/add.favs.ajax.php",
            type: "POST",
            data: {
                'dork_id' : $dorkID,
                'thing_id' : $id
            }, // End data
            'beforeSend': function() {
                $requestRunning = true;
                $('.highlight').removeClass('highlight');
                $('.loader_large').removeClass('hidden');
                $('html').not('.loader_large').addClass('dim');
            }, // End beforeSend
            'success': function() {
                $requestRunning = false;
                
                $name = $name.replace(/'/g,"&apos;"); 
                $description = $description.replace(/'/g,"&apos;");
                
                $output = "<li title='" + $description + "' id='fav_" + $id + "'>";
                $output += "<a href='index.php?dork=" + $dorkID + "&amp;thing=" + $id + "'>" + $name + "</a>";
                $output += "</li>";
                
                $("ul.favs").append($output);
                
                tinysort('.favs li');
                
                $(".favs li#fav_" + $id).draggable({
                   helper: 'clone'
                });
                
                $this_added = $('li#fav_' + $id);
                $this_added.addClass('highlight');
                $('.loader_large').addClass('hidden');
                $('html').not('.loader_large').removeClass('dim');
                
                $('.favs li').mouseover(function() {
                    $('.highlight').removeClass('highlight');
                });
                
                $this.html("<p>Remove From Favorites</p>").removeClass('add').addClass('remove');
                
                $('.trash, .favs, .non_favs').removeClass('hidden');
                $('.favs_list h2').text("Favorite Things");
                
                if ($('.favs li').length===0) {
                    $('.trash, .favs').addClass('hidden');
                    $('.favs_list h2').text("No Favorite Things");
                    $('.non_favs').removeClass('hidden');
                }
                
                if ($('.non_favs li').length===0) {
                    $('.trash, .favs').removeClass('hidden');
                    $('.favs_list h2').text("Favorite Things");
                    $('.non_favs').addClass('hidden');
                }
                
            } // End success
        }); // End AJAX
        
    }); // End movie_list click function
}); // End document ready

$(document).ready(function() { // Remove From Favorites From Single Thing Page
    $requestRunning = false;
    $(document).on('click', '.actions .remove', function() {
        if ($requestRunning) {
            return; // Don't do anything if an AJAX request is running
        }
        
        $this = $(this);
        $id = $this.attr('id').split("_");
        $id = $id[1];
        
        $.ajax({
            url: "ajax/remove.favs.ajax.php",
            type: "POST",
            data: {
                'dork_id' : $dorkID,
                'thing_id' : $id
            }, // End data
            'beforeSend': function(){
                $requestRunning = true;
                $('.trash').addClass('trash_hover');
                $('.loader_large').removeClass('hidden');
                $('html').not('.loader_large').addClass('dim');
            }, // End beforeSend
            'success': function() {
                $requestRunning = false;
                $('.trash').removeClass('trash_hover');                
                $this.html("<p>Add To Favorites</p>").removeClass('remove').addClass('add');
                $('li#fav_' + $id).remove();
                
                $('.trash, .favs, .non_favs').removeClass('hidden');
                $('.favs_list h2').text("Favorite Things");
                
                if ($('.favs li').length===0) {
                    $('.trash, .favs').addClass('hidden');
                    $('.favs_list h2').text("No Favorite Things");
                    $('.non_favs').removeClass('hidden');
                }
                
                $('.loader_large').addClass('hidden');
                $('html').not('.loader_large').removeClass('dim');
            } // End success
        }); // End AJAX
        
    }); // End movie_list click function
}); // End document ready

$(document).ready(function() { // Navigation
    $('.select_dorks, .dorks_menu').mouseover(function() {
        $('.dorks_menu').removeClass('hidden');
        $('.admin_menu').addClass('hidden');
    });
    
    $('.dorks_menu, .admin_menu').mouseout(function() {
        $(this).addClass('hidden');
    });
    
    $('.admin_button, .admin_menu').mouseover(function() {
        $('.dorks_menu').addClass('hidden');
        $('.admin_menu').removeClass('hidden');
    });
    
}); // End document ready

$(document).ready(function() { //Delete Dork
    $(document).on('mouseover mouseout', '.insertcell', function() {
        $('.insert', this).toggleClass('hidden');
    });
    
    $(document).on('mouseover mouseout', '.deletecell', function() {
        $('.delete', this).toggleClass('hidden');
    });
    
    $(document).on('click', '.delete', function() {
        $this = $(this);
        $id = $this.closest('tr').attr('id').split("_");
        $id = $id[1];
    
        $.ajax({
            url: "/somethingdorky/ajax/delete.dork.ajax.php",
            type: "POST",
            data: {
                'dork_id': $id
            }, // End data
            'beforeSend': function(){
                $this.removeClass('delete').addClass('loader_small');
            }, // End beforeSend
            'success': function() {
                $('tr#dork_' + $id + ', li#dorklist_' + $id).remove();
            } // End success
        }); // End AJAX
        
    }); // End  Delete dork function
}); // End document ready

$(document).ready(function() { //Delete thing
    $(document).on('click', '.delete', function() {
        $this = $(this);
        $id = $this.closest('tr').attr('id').split("_");
        $id = $id[1];
    
        $.ajax({
            url: "ajax/delete.thing.ajax.php",
            type: "POST",
            data: {
                'thing_id': $id
            }, // End data
            'beforeSend': function(){
                $this.removeClass('delete').addClass('loader_small');
            }, // End beforeSend
            'success': function() {
                $('tr#thing_' + $id).remove();
            } // End success
        }); // End AJAX
        
    }); // End  Delete thing function
}); //End Document ready

$(document).ready(function() { // Add Dork
    $(document).on('focus mouseover', '.newdatarow', function() {
        $('.insert').removeClass('hidden');    
    });
    
    $(document).on('click', '.insert', function() {
        $this = $(this);
        
        $dorkFirst = $('input.newdata[name="dork_first_name"]').val();
        $dorkLast = $('input.newdata[name="dork_last_name"]').val();
        $dorkDork = $('input.newdata[name="dork_dork_name"]').val();
        
        if ($dorkDork==="") {
            alert("Please enter a Dork Name!");
            $this.removeClass('loader_small').addClass('insert');
            $('input.newdata[name="dork_dork_name"]').focus();
            return;
        }
        
        $.ajax({
            url: "ajax/add.dork.ajax.php",
            type: "POST",
            data: {
                'dork_first_name' : $dorkFirst,
                'dork_last_name' : $dorkLast,
                'dork_dork_name' : $dorkDork
            }, // End data
            'beforeSend': function() {
                $requestRunning = true;
                $this.removeClass('insert').addClass('loader_small');
                $('.delete').removeClass('success').addClass('hidden');
            }, // End beforeSend
            'success': function(response) {
                $dorkID = response;
                
                $requestRunning = false;
                $('input.newdata').val('');
                
                $dorkFirst = $dorkFirst.replace(/'/g,"&apos;"); 
                $dorkLast = $dorkLast.replace(/'/g,"&apos;");
                $dorkDork = $dorkDork.replace(/'/g,"&apos;");
                
                $output = "<tr id='dork_" + $dorkID + "' class='datarow'>";
                $output += "<td><input class='data' type='text' name='dork_first_name' value='" + $dorkFirst + "'></td>";
                $output += "<td><input class='data' type='text' name='dork_last_name' value='" + $dorkLast + "'></td>";
                $output += "<td><input class='data' type='text' name='dork_dork_name' value='" + $dorkDork + "'></td>";
                $output += "<td class='deletecell'><div class='delete hidden'></div></td>";
                $output += "</tr>";
                
                $('.admin_table tr:last').before($output);
                
                $output = "<li id='dorklist_" + $dorkID + "'>";
                $output += "<a href='index.php?dork=" + $dorkID + "'>" + $dorkDork + "</a>";
                $output += "</li>";
                
                $('.dorks_menu').append($output);
                tinysort('.dorks_menu li');
                
                $('.delete:last').removeClass('loader_small').addClass('success');
                $this.removeClass('loader_small').addClass('insert');
                
                $(document).on('mouseover', '.deletecell', function() {
                    $('.delete', this).removeClass('hidden success');
                });
                
            } // End success
        }); // End AJAX
        
    }); // End movie_list click function
}); // End document ready

$(document).ready(function() { // Add Thing
    $(document).on('focus mouseover', '.newdatarow', function() {
        $('.insert').removeClass('hidden');    
    });
    
    $(document).on('click', '.insert', function() {
        $this = $(this);
        
        $thingName = $('input.newdata[name="thing_name"]').val();
        $thingDescription = $('input.newdata[name="thing_description"]').val();
        
        if ($thingName==="") {
            alert("Please enter a Thing Name!");
            $this.removeClass('loader_small').addClass('insert');
            $('input.newdata[name="thing_name"]').focus();
            return;
        }
        
        $.ajax({
            url: "ajax/add.thing.ajax.php",
            type: "POST",
            data: {
                'thing_name' : $thingName,
                'thing_description' : $thingDescription
            }, // End data
            'beforeSend': function() {
                $requestRunning = true;
                $this.removeClass('insert').addClass('loader_small');
                $('.delete').removeClass('success').addClass('hidden');
            }, // End beforeSend
            'success': function(response) {
                $thingID = response;
                
                $requestRunning = false;
                $('input.newdata').val('');
                
                $thingName = $thingName.replace(/'/g,"&apos;"); 
                $thingDescription = $thingDescription.replace(/'/g,"&apos;");
                
                $output = "<tr id='thing_" + $dorkID + "' class='datarow'>";
                $output += "<td><input class='data' type='text' name='thing_name' value='" + $thingName + "'></td>";
                $output += "<td><input class='data' type='text' name='thing_description' value='" + $thingDescription + "'></td>";
                $output += "<td class='deletecell'><div class='delete hidden'></div></td>";
                $output += "</tr>";
                
                $('.admin_table tr:last').before($output);
                
                $('.delete:last').removeClass('loader_small').addClass('success');
                $this.removeClass('loader_small').addClass('insert');
                
                $(document).on('mouseover', '.deletecell', function() {
                    $('.delete', this).removeClass('hidden success');
                });
                
            } // End success
        }); // End AJAX
        
    }); // End movie_list click function
}); // End document ready

$(document).ready(function() { // Update Dork
    $(document).on('focus', '.data', function() {
        $this = $(this);
        $id = $this.closest('tr').attr('id').split("_");
        $id = $id[1];
         
        $thisName = $this.val();
        $thisField = $this.attr('name');
        
        $refreshList = false;
        $otherField1 = "";
        $otherField2 = "";
        
        switch($thisField) {
            case "dork_first_name":
                $otherField1 = "dork_last_name";
                $otherField2 = "dork_dork_name";
                break;
            case 'dork_last_name':
                $otherField1 = "dork_first_name";
                $otherField2 = "dork_dork_name";
                break;
            case 'dork_dork_name':
                $otherField1 = "dork_first_name";
                $otherField2 = "dork_last_name";
                $refreshList = true;
                break;
        }
        
        $otherName1 = $('tr#dork_' + $id + ' .data[name="' + $otherField1 + '"]').val();
        $otherName2 = $('tr#dork_' + $id + ' .data[name="' + $otherField2 + '"]').val();
        
        $this.on('focusout', function() {
            $newName = $this.val();
            
            if($newName!=$thisName) {
                $.ajax({
                    url: "ajax/update.dork.ajax.php",
                    type: "POST",
                    data: {
                        'this_field' : $thisField,
                        'dork_id' : $id,
                        'new_name' : $newName
                    }, // End data
                    'beforeSend': function() {
                        $('.success').removeClass('success').addClass('delete hidden');
                        $('#dork_' + $id + ' .deletecell div').removeClass('delete hidden').addClass('loader_small');
                    }, // End beforeSend
                    'success': function() {
                        $('.loader_small').removeClass('loader_small').addClass('success');
                        
                        $(document).on('mouseover', '.deletecell', function() {
                            $('.success', this).addClass('delete').removeClass('hidden success');
                        });
                    } // End success
                }); // End AJAX
                
                if ($refreshList===true) {
                    $output = "<li id='dorklist_" + $id + "'>";
                    $output += "<a href='index.php?dork=" + $id + "'>" + $newName + "</a>";
                    $output += "</li>";
                    
                    $('li#dorklist_' + $id).remove();
                    $('.dorks_menu').append($output);
                    tinysort('.dorks_menu li');
                }
            }
        }); // End focusout
    }); // End focus first name function
}); // End document ready

$(document).ready(function() { // Update Thing
    $(document).on('focus', '.data', function() {
        $this = $(this);
        $id = $this.closest('tr').attr('id').split("_");
        $id = $id[1];
         
        $thisField = $this.attr('name');
        $thisData = $this.val();
        
        switch($thisField) {
            case "thing_name":
                $otherField1 = "thing_description";
                break;
            case 'thing_description':
                $otherField1 = "thing_name";
                break;
        }
        
        $otherData1 = $('tr#thing_' + $id + ' .data[name="' + $otherField1 + '"]').val();
        
        $this.on('focusout', function() {
            $newData = $this.val();
            
            if($newData!=$thisData) {
                $.ajax({
                    url: "ajax/update.thing.ajax.php",
                    type: "POST",
                    data: {
                        'this_field' : $thisField,
                        'thing_id' : $id,
                        'new_data' : $newData
                    }, // End data
                    'beforeSend': function() {
                        $('.success').removeClass('success').addClass('delete hidden');
                        $('#thing_' + $id + ' .deletecell div').removeClass('delete hidden').addClass('loader_small');
                    }, // End beforeSend
                    'success': function() {
                        $('.loader_small').removeClass('loader_small').addClass('success');
                        
                        $(document).on('mouseover', '.deletecell', function() {
                            $('.success', this).addClass('delete').removeClass('hidden success');
                        });
                    } // End success
                }); // End AJAX
            }
        }); // End focusout
    }); // End focus first name function
}); // End document ready