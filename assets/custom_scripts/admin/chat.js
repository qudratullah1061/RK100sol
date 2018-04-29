var current_chat_id;
var Templates = function () {
    var appendTemplateOneToOne = function (messages) {
        var message = "";
        var unread = 0;
        var users = current_chat_id.split('-');
        var user1 = users[0];
        var user2 = users[1];
//        $(".general-item-list").html("");
        for (var key in messages) {
            message = '<div class="item">' +
                    '<div class="item-head">' +
                    '<div class="item-details">' +
                    '<img class="item-pic rounded" src="' + base_url + '/assets/pages/media/users/avatar4.jpg">' +
                    '<a href="" class="item-name primary-link">Nick Larson</a>' +
                    '<span class="item-label">3 hrs ago</span>' +
                    '</div>' +
                    '<span class="item-status">' +
                    '<span class="badge badge-empty badge-success"></span> Open</span>' +
                    '</div>' +
                    '<div class="item-body">' + messages[key].message + '</div>' +
                    '</div>';
            $(".general-item-list").append(message);
            if (messages[key].is_read == "0") {
                unread++;
            }
        }
        unread > 0 ? $(".member-" + user2).html(unread) : $(".member-" + user2).hide();
    };

    var appendSingleMessage = function (message_obj) {
        var message = "";
        var unread = 0;
        var users = current_chat_id.split('-');
        var user1 = users[0];
        var user2 = users[1];
        message = '<div class="item">' +
                '<div class="item-head">' +
                '<div class="item-details">' +
                '<img class="item-pic rounded" src="' + base_url + '/assets/pages/media/users/avatar4.jpg">' +
                '<a href="" class="item-name primary-link">Nick Larson</a>' +
                '<span class="item-label">3 hrs ago</span>' +
                '</div>' +
                '<span class="item-status">' +
                '<span class="badge badge-empty badge-success"></span> Open</span>' +
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
                conversationRef.child(conversation_key).once('value', function (snapMessages) {
                    var chat_users = snapMessages.key.split("-");
                    $(".member-" + chat_users[1]).html("");
                    var messages = snapMessages.val();
                    for (var msg_key in messages) {
                        if (snapMessages.key != current_chat_id) {
                            if (messages[msg_key].is_read == 0) {
                                $(".member-" + chat_users[1]).html(parseInt($(".member-" + chat_users[1]).html() != "" ? $(".member-" + chat_users[1]).html() : 0) + 1);
                            }
                        } else {
                            // mark this messaage as read.
                            conversationRef.child(conversation_key).child(msg_key).update({is_read: 1}, function (err) {
                                if (err) {
                                    console.warn("update error!", err);
                                }
                            });
                        }
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
    var getChatMessages = function (chat_id) {
        current_chat_id = chat_id;
        $(".general-item-list").html("");
        conversationRef.child(chat_id).on('child_added', function (snapshot) {
            if (chat_id == current_chat_id) {
                var obj = snapshot.val();
                obj.key = snapshot.key;
                Templates._appendSingleMessage(obj);
            } else {
                // add number incremental +1 value. else condition will call only when new child added.
                var chat_users = chat_id.split("-");
                $(".member-" + chat_users[1]).html(parseInt($(".member-" + chat_users[1]).html()) + 1);
            }
        });

        conversationRef.child(chat_id).on('child_changed', function (snapshot) {
            console.log('update call nested');
        });
    };

    var updateChatMessagesAsRead = function (chat_id) {
        var chatRef = conversationRef.child(chat_id);
        chatRef.once('value', function (snapMessages) {
            var chat_users = chat_id.split("-");
            $(".member-" + chat_users[1]).html("");
            var messages = snapMessages.val();
            for (var msg_key in messages) {
                if (messages[msg_key].is_read == 0) {
                    chatRef.child(msg_key).update({is_read: 1}, function (err) {
                        if (err) {
                            console.warn("update error!", err);
                        }
                    });
                }
            }
        });
    }

    var addMessage = function (current_chat_id) {
        var users = current_chat_id.split('-');
        var user1 = users[0];
        var user2 = users[1];
        var msg = $(".msg-box").val();
        var currentChatRef = firebase.database().ref('conversations/' + current_chat_id);
        currentChatRef.push().set({'sender_id': user1, 'receiver_id': user2, 'is_read': 0, 'message': msg, 'date_sent': (new Date()).toString()});
    }

    return {
        init: function () {
            initFirebase();
            initMessageCounters();
        },
        getChatMessages: function (chat_id) {
            $(".mt-comment").removeClass('active_chat');
            $(".mt-comment-" + chat_id).addClass('active_chat');
            conversationRef.child(chat_id).off();
            getChatMessages(chat_id);
            updateChatMessagesAsRead(chat_id);
        },
        sendChatMessage: function () {
            addMessage(current_chat_id);
        }
    };
}();