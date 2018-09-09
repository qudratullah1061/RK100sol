var current_chat_id;
var usersInfo = {};
var Templates = function () {
    var appendTemplateOneToOne = function (messages) {
        var message = "";
        var unread = 0;
        var users = current_chat_id.split('-');
        var user1 = users[0];
        var user2 = users[1];
        var ui_ref = (users[0] == senderID ? users[1] : users[0]);
        for (var key in messages) {
            message = '<div class="item">' +
                    '<div class="item-head">' +
                    '<div class="item-details">' +
                    '<img class="item-pic rounded" src="' + base_url + usersInfo[messages[key].sender_id] + '">' +
                    '<a href="" class="item-name primary-link">Nick Larson</a>' +
                    '<span class="item-label">3 hrs ago</span>' +
                    '</div>' +
                    '<span class="item-status cursor-pointer">' +
                    '<span class="badge badge-empty badge-success"></span> Delete</span>' +
                    '</div>' +
                    '<div class="item-body">' + messages[key].message + '</div>' +
                    '</div>';
            $(".general-item-list").append(message);
            if (messages[key]['is_read_' + ui_ref] == "0") {
                unread++;
            }
        }
        unread > 0 ? $(".member-" + current_chat_id).html(unread) : $(".member-" + current_chat_id).hide();
    };

    var getLocalDateTime = function (dateTimeSent) {
        var r = new Date(dateTimeSent);
        var h = r.getHours();
        var m = r.getMinutes();
        var s = r.getSeconds();
        var _time = (h > 12) ? (h - 12 + ':' + m + ':' + s + ' PM') : (h + ':' + m + ':' + s + ' AM');
        return (r.getFullYear() + "-" + (r.getMonth() + 1) + "-" + r.getDate() + " " + _time);
    }

    var appendSingleMessage = function (message_obj) {
        var message = "";
        var image = "";
        var unread = 0;
        var users = current_chat_id.split('-');
        var user1 = users[0];
        var user2 = users[1];
        message = '<div class="item item-' + message_obj.key + '">' +
                '<div class="item-head">' +
                '<div class="item-details">';
        if (usersInfo[message_obj.sender_id].image_path == '') {
            image = '<img class="item-pic rounded" src="' + base_url + 'uploads/member_images/profile/profile.png">';
        } else {
            image = '<img class="item-pic rounded" src="' + base_url + usersInfo[message_obj.sender_id].image_path + usersInfo[message_obj.sender_id].image + '">';
        }
        message += image +
                '<a href="javascript:;" class="item-name primary-link">' + usersInfo[message_obj.sender_id].first_name + ' ' + usersInfo[message_obj.sender_id].last_name + '</a>' +
                '<span class="item-label">' + getLocalDateTime(message_obj.date_sent) + '</span>' +
                '</div>' +
                (message_obj.sender_id == senderID ? ('<span class="item-status cursor-pointer" onclick="Chat.deleteMessage(\'' + message_obj.key + '\')"><span class="badge badge-empty badge-success"></span> Delete</span>') : "") +
                '</div>' +
                '<div class="item-body">' + message_obj.message + '</div>' +
                '</div>';
        $(".general-item-list").append(message);
    }

    return {
        _templateOneToOne: function (messages) {
            appendTemplateOneToOne(messages);
        },
        _appendSingleMessage: function (message) {
            appendSingleMessage(message);
        }
    };
}();
var conversationRef;

var Chat = function () {

    var flattenObject = function (snapObjects) {
        var result = [];
        if (snapObjects != null) {
            var keys = Object.keys(snapObjects),
                    i = keys.length,
                    snap;
            while (i--) {
                snap = snapObjects[keys[i]];
                snap.key = keys[i];
                result.unshift(snap);
            }
        }
        return result;
    }

    var initFirebase = function () {
        var config = {
            apiKey: "AIzaSyCWbdaGdf2TJD8CC84q--Aw0GBzOJcFLo8",
            authDomain: "konsorts-180810.firebaseapp.com",
            databaseURL: "https://konsorts-180810.firebaseio.com",
            projectId: "konsorts-180810",
            storageBucket: "konsorts-180810.appspot.com",
            messagingSenderId: "209256789157"
        };
        firebase.initializeApp(config);
        conversationRef = firebase.database().ref('conversations');
    };

    var initMessageCounters = function () {
        // set message counters
        conversationRef.on('value', function (snapshot) {
            var conversation_objects = snapshot.val();
            //console.log(conversation_objects);
            for (var conversation_key in conversation_objects) {
                conversationRef.child(conversation_key).limitToLast(500).once('value', function (snapMessages) {
                    var chat_users = snapMessages.key.split("-");
                    // update conversation ref.
                    var ui_ref = (chat_users[0] == senderID ? chat_users[1] : chat_users[0]);
                    $(".member-" + snapMessages.key).html("");
                    var messages = snapMessages.val();
                    var is_unread = false;
                    for (var msg_key in messages) {
                        if (snapMessages.key != current_chat_id) {
                            if (messages[msg_key]['is_read_' + ui_ref] == 0) {
                                $(".member-" + snapMessages.key).html(parseInt($(".member-" + snapMessages.key).html() != "" ? $(".member-" + snapMessages.key).html() : 0) + 1);
                                is_unread = true;
                            }
                        } else {
                            // mark this messaage as read.
                            conversationRef.child(conversation_key).child(msg_key).update({['is_read_' + ui_ref]: 1}, function (err) {
                                if (err) {
                                    console.warn("update error!", err);
                                }
                            });
                        }
                    }
                    if (is_unread) {
                        $(".mt-comment-" + snapMessages.key).prependTo($(".mt-comment-" + snapMessages.key).parent());
                    }
                });
            }
        });
    };

    var showChatMessages = function (chatMessagesObj) {
        var messages = flattenObject(chatMessagesObj);
        // append template
        Templates._templateOneToOne(messages);
    };

    var deleteMessage = function (message_id) {
        conversationRef.child(current_chat_id).child(message_id).remove();
    };

    var getChatMessages = function (chat_id) {
        $(".scroll-custom").removeClass('chat-' + current_chat_id);
        $(".scroll-custom").addClass('chat-' + chat_id);
        current_chat_id = chat_id;
        var chat_users = chat_id.split("-");
        var ui_ref = (chat_users[0] == senderID ? chat_users[1] : chat_users[0]);
        $(".general-item-list").html("");
        conversationRef.child(chat_id).limitToLast(500).on('child_added', function (snapshot) {
            if (chat_id == current_chat_id) {
                var obj = snapshot.val();
                obj.key = snapshot.key;
                Templates._appendSingleMessage(obj);
            } else {
                // add number incremental +1 value. else condition will call only when new child added.
                $(".member-" + chat_id).html(parseInt($(".member-" + chat_id).html() != "" ? $(".member-" + chat_id).html() : 0) + 1);
            }
        });

        conversationRef.child(chat_id).on('child_changed', function (snapshot) {
            $(".mt-comment-" + chat_id).prependTo($(".mt-comment-" + chat_id).parent());
            if ($('.chat-' + chat_id).length > 0) {
                $('.chat-' + chat_id).slimScroll({
                    scrollTo: $('.chat-' + chat_id)[0].scrollHeight
                });
            }
        });

        conversationRef.child(chat_id).on('child_removed', function (snapshot) {
            $(".item-" + snapshot.key).remove();
        });

        var container = $(".scroll-custom");
        container.slimScroll({
            scrollTo: container[0].scrollHeight
        });
    };

    var updateChatMessagesAsRead = function (chat_id) {
        var chatRef = conversationRef.child(chat_id);
        chatRef.once('value', function (snapMessages) {
            var chat_users = chat_id.split("-");
            var ui_ref = (chat_users[0] == senderID ? chat_users[1] : chat_users[0]);
            $(".member-" + chat_id).html("");
            var messages = snapMessages.val();
            for (var msg_key in messages) {
                if (messages[msg_key]["is_read_" + ui_ref] == 0) {
                    chatRef.child(msg_key).update({['is_read_' + ui_ref]: 1}, function (err) {
                        if (err) {
                            console.warn("update error!", err);
                        }
                    });
                }
            }
        });
    };

    var addMessage = function (current_chat_id) {
        if (typeof current_chat_id != "undefined") {
            var users = current_chat_id.split('-');
            var user1 = users[0];
            var user2 = users[1];
            var msg = $(".msg-box").val();
            var currentChatRef = firebase.database().ref('conversations/' + current_chat_id);
            currentChatRef.push().set({
                'sender_id': senderID,
                'receiver_id': (senderID == user1) ? user2 : user1,
                ['is_read_' + user1]: (senderID == user1 ? 0 : 1),
                ['is_read_' + user2]: (senderID == user2 ? 0 : 1),
                'message': msg,
                'date_sent': (new Date()).toString()
            });
            $(".msg-box").val("");
//            var container = $(".scroll-custom");
//            container.slimScroll({
//                scrollTo: container[0].scrollHeight
//            });
        } else {
            toastr["info"]("Please select chat to send message.", "Info");
        }
    };

    var initMessageInput = function () {
        $(".msg-box").keypress(function (event) {
            if (event.which == 13) {
                event.preventDefault();
                addMessage(current_chat_id);
            }
        });
    };


    var populateUserInfo = function (chat_id, is_admin) {
        if (typeof chat_id != "undefined") {
            var users = chat_id.split('-');
            var user1 = users[0];
            var user2 = users[1];
            var url = base_url + "admin/chat/getUserInfoForChat";
            if (is_admin == 0) {
                url = base_url + "chat/getUserInfoForChat";
            }
            $.ajax({
                type: "POST",
                url: url,
                datatype: 'json',
                data: {chat_id: chat_id},
                beforeSend: function () {
                    App.blockUI({target: 'body', animate: true});
                },
                complete: function () {
                    App.unblockUI('body');
                },
                success: function (data) {
                    if (!data.error) {
                        user1Info = data[user1];
                        user2Info = data[user2];
                        usersInfo[user1] = user1Info;
                        usersInfo[user2] = user2Info;
                        getChatMessages(chat_id);
                        updateChatMessagesAsRead(chat_id);
                    } else {
                        toastr["error"](data.description, "Error!");
                    }
                }
            });
        }
    };

    return {
        init: function () {
            initFirebase();
            initMessageCounters();
            initMessageInput();
        },
        getChatMessages: function (chat_id, is_admin) {
            $(".mt-comment").removeClass('active_chat');
            $(".mt-comment-" + chat_id).addClass('active_chat');
            conversationRef.child(chat_id).off();
            // get user info here.
            populateUserInfo(chat_id, is_admin);
        },
        sendChatMessage: function () {
            addMessage(current_chat_id);
        },
        deleteMessage: function (message_id) {
            deleteMessage(message_id);
        }
    };
}();
