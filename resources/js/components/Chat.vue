<template>
<div class="chat-wrapper" :class="{'hide-chat': isShow}">
    <div class="global-chat_inner" ref="dragndrop" :class="{'dragndrop__active': isDraging}">
        <div class="dragndrop" v-show="isDraging">
            <div class="dragndrop_inner">Отпустите для загрузки изображения</div>
        </div>
        <div class="global-chat_header line-1 text-bold py-2 px-3" @click="toggleChat">
            <div class="arrower">
                <span v-if="isShow"><small class="font-normal">Развернуть чат</small></span>
                <span v-else><small class="font-normal">Свернуть чат</small></span>
            </div>
            <span><span class="dot"></span> LIVE</span>
            <small class="chat-online float-right" v-if="isManage">Смотрят: {{ users.length }} чел</small>
        </div>
            <div class="chat-feed" ref="chatfeed">
                <div v-if="loaded == false" class="min-loader d-flex justify-content-center">
                    <div class="spinner-border" role="status">
                    <span class="sr-only">Loading...</span>
                    </div>
                </div>
                <div v-else v-for="post in messages" :key="`message_post_${post.id}`" class="global-chat__message" :class="{'owner': post.user.id == userO.id}">
                    <button v-if="userO.is_manager === 1" @click="hideMessage(post.id)" class="btn btn-danger btn-sm btn-hide"><i class="fas fa-minus-circle"></i></button>

                    <div class="chat-author mt-0" :class="{'chat-owner': post.user.id == userO.id}">{{post.user.name}}
                        <span v-if="post.user.id == userO.id"></span>
                    </div>

                    <div v-if="post.type_id === 'text'" class="global-chat__message__body">
                        <div v-if="post.reply" class="reply-message_wrapper">
                            <div v-if="post.reply.type_id === 'text'">
                                <div class="reply-message_author">{{ post.reply.user.name }}</div>
                                <div class="reply-message_body">{{ post.reply.body }}</div>
                            </div>
                            <div v-else @click="showPreview(post.reply.body)" class="image-previewer">
                                <div class="reply-message_author">{{ post.reply.user.name }}</div>
                                <img :src="`${post.reply.body}`" alt="">
                            </div>
                        </div>
                        <div>{{ post.body }}</div>
                    </div>
                    <div v-else @click="showPreview(post.body)" class="image-previewer">
                        <img :src="`${post.body}`" alt="">
                    </div>

                    <div class="chat-message_footer">
                        <div class="d-flex flex-row align-items-center">
                            <button @click="like(post.id)" class="btn btn-like" :class="{'like-positive': post.likes.length > 0}">
                                <span :ref="`post_like_${post.id}`" class="like-wrapper">
                                    <i class="fas fa-heart" v-if="isLikedByUser(post.id, userO.id)"></i>
                                    <i class="far fa-heart" v-else></i>
                                </span>
                                    <small v-show="post.likes.length > 0">{{ post.likes.length }}</small>
                            </button>

                            <span @click="addReply(post.id)" class="reply-button">Ответить</span>
                        </div>
                            <!-- <button @click="dislike(post.id)" class="btn btn-dislike"><i class="las la-thumbs-down la-lg"></i> <small>{{ post.dislikes.length }}</small></button> -->
                        <div class="text-muted chat-timestamp">{{ moment(post.created_at).format('H:mm D.M.YYYY') }}</div>
                    </div>
                </div>
            </div>

            <div v-if="allowChat == 1" class="chat-input__wrapper">
                <div v-if="replyId != -1" class="reply-wrapper">
                    <div class="reply-wrapper_inner">
                        <div class="reply-author">{{ reply.author }}</div>
                        <div class="reply-message">{{ reply.message }}</div>
                    </div>

                    <div @click="removeReply" class="reply-refuse"><i class="fas fa-times"></i></div>
                </div>

                <div class="d-flex justify-content-center">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <input ref="imageRef" class="d-none" @change="fileUpload" type="file" accept="image/*" />
                            <button @click.prevent="uploadImage" :disabled="!loadedButton" class="btn btn-link" type="button"><i class="fas fa-camera"></i></button>
                        </div>

                        <!-- <input ref="globalchatmessage" v-model="message" @keyup.enter="sendViaEnter" type="text" class="form-control"> -->
                        <!-- <textarea ref="globalchatmessage" v-model="message" @keyup.enter="sendViaEnter" type="text" class="form-control"></textarea> -->

                        <textarea-autosize
                            placeholder="Ваше сообщение..."
                            ref="globalchatmessage"
                            v-model="message"
                            rows="1"
                            :min-height="30"
                            :max-height="250"
                            class="form-control"
                            @keydown.enter.native.exact.prevent="sendViaEnter"
                        />

                        <div class="input-group-append">
                            <emoji-picker @emoji="insert" :emojiTable="stickers" class="emoji-button">
                                <div slot="emoji-invoker" slot-scope="{ events: { click: clickEvent } }" @click.stop="clickEvent">
                                    <button class="btn btn-link" type="button"><i class="far fa-smile"></i></button>
                                </div>
                                <div class="emoji-picker" slot="emoji-picker" slot-scope="{ emojis, insert, display }">
                                    <div v-for="(emojiGroup, category) in emojis" :key="category">
                                        <div>
                                            <span
                                            v-for="(emoji, emojiName) in emojiGroup"
                                            :key="emojiName"
                                            @click="insert(emoji)"
                                            :title="emojiName"
                                            >{{ emoji }}</span>
                                        </div>
                                    </div>
                                </div>
                            </emoji-picker>

                            <button @click.prevent="sendChatMessage" :disabled="!loadedButton" class="btn" type="button"><i class="fas fa-paper-plane"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <div v-else class="chat-input__wrapper">
                <button class="btn btn-primary w-100" @click="show">Войти</button>
            </div>

        <div v-if="preview" class="image-big-preview" @click="hidePreview">
            <div class="image-big-preview__image" :style="`background-image: url(${previewImage})`"></div>
        </div>
    </div>
</div>
</template>

<script>
import moment from 'moment'
import ru from 'moment/locale/ru'

export default {
    props: {
        allowChat: Number,
        user: String,
    },
    data() {
        return {
            isShow: true,
            stickers: {
                'fu': {
                    'smile': '😄',
                    'heart_eyes': '😍',
                    'rage': '😡',
                    'yum': '😋',
                    'hankey': '💩',
                    'fire': '🔥',
                    '-1': '👎',
                    'hand': '✋',
                    'heartpulse': '💗',
                }
            },
            moment: moment,
            loaded: false,
            users: [],
            userO: '',
            loadedButton: true,
            messages: [],
            message: null,
            page: 1,
            preview: false,
            previewImage: null,
            isFileUploading: false,
            uploadImageSrc: null,
            previewImageTemp: null,
            isDraging: false,
            counter: 0,
            hasMore: true,
            moreLoading: false,
            replyId: -1,
            reply: {},
            isManage: {},
        }
    },
    created() {
        moment.locale('ru');
    },
    mounted() {
        this.userO = this.user != '' ? JSON.parse(this.user) : ''
        this.isManage = this.isManagerCheck()

        axios.get('/chat')
            .then((response) => {
                this.messages = response.data.messages.data
                this.messages.forEach(message => {
                    if(message.reactions != null) {
                        message.likes = message.reactions.filter(item => item.type_id === 'like')
                        message.dislikes = message.reactions.filter(item => item.type_id === 'dislike')
                    } else {
                        message.likes = []
                        message.dislikes = []
                    }
                })

                this.loaded = true
            })

        Echo.join('bans')
            .listen('BanEvent', (e) => {
                let idx = this.messages.findIndex(item => item.id === e.message.id)
                this.messages.splice(idx, 1)
            });

        Echo.join('likes')
            .listen('LikeEvent', (e) => {
                const idx = this.messages.findIndex(item => item.id === e.message.id)

                let tempNewMessage = e.message
                if(tempNewMessage.reactions != null) {
                    tempNewMessage.likes = tempNewMessage.reactions.filter(item => item.type_id === 'like')
                    tempNewMessage.dislikes = tempNewMessage.reactions.filter(item => item.type_id === 'dislike')
                } else {
                    tempNewMessage.likes = []
                    tempNewMessage.dislikes = []
                }

                this.messages[idx] = tempNewMessage
                this.$forceUpdate()
            });

        Echo.join('chat')
            .here((users) => {
                this.users = users;

            })
            .joining((user) => {
                if (this.checkIfUserAlreadyOnline(user) === -1) this.addUser(user);
                // axios.post('/joining', {'user_id': user.id});
            })
            .leaving((user) => {
                this.removeUser(user);
                // axios.post('/leaving', {'user_id': user.id});
            })
            .listen('ChatEvent', (e) => {
                this.messages.unshift(
                    {...e.message, likes: [], dislikes: []}
                )

                this.$nextTick(() => {
                    this.$refs.chatfeed.scrollTop = 0
                })
            });

        this.$refs.dragndrop.addEventListener('dragenter', this.handleDragIn)
        this.$refs.dragndrop.addEventListener('dragleave', this.handleDragOut)
        this.$refs.dragndrop.addEventListener('dragover', this.handleDrag)
        this.$refs.dragndrop.addEventListener('drop', this.handleDrop)

        let that = this

        this.$refs.chatfeed.onscroll = _.debounce(function () {
            if (that.moreLoading || !that.hasMore) return;
            if (that.$refs.chatfeed.clientHeight + that.$refs.chatfeed.scrollTop <= 400) that.showMore()
        }, 100)
    },
    methods: {
        isManagerCheck() {
            if (this.userO.roles.find(x => x.slug === 'manager') !== undefined) {
                return this.userO.roles.find(x => x.slug === 'manager').slug === 'manager'
            }
            return false
        },

        addReply(postId) {
            this.replyId = postId

            const idx = this.messages.findIndex(item => item.id === postId)

            if(idx != -1) {
                const replyMessage = this.messages[idx]

                this.reply = {
                    author: replyMessage.user.first_name + ' ' + replyMessage.user.last_name,
                    message: replyMessage.type_id === 'text' ? replyMessage.body : 'изображение'
                }

                this.$refs.globalchatmessage.$el.focus();
            }
        },
        removeReply() {
            this.reply = {}
            this.replyId = -1
        },
        toggleChat() {
            this.isShow = !this.isShow
        },
        insert(emoji) {
            let cursorPosition = this.getCaretPosition();
            if(this.message) {
                // this.message = this.message.substring(0, cursorPosition.end) + emoji + this.message.substr(cursorPosition.end)
                this.message = this.message + emoji
            } else
                this.message = emoji
        },
        getCaretPosition() {
            // IE < 9 Support
            if (document.selection) {
                this.$refs.globalchatmessage.$el.focus();
                var range = document.selection.createRange();
                var rangelen = range.text.length;
                range.moveStart('character', -this.$refs.globalchatmessage.$el.value.length);
                var start = range.text.length - rangelen;
                return {
                    'start': start,
                    'end': start + rangelen
                };
            } // IE >=9 and other browsers
            else if (this.$refs.globalchatmessage.$el.selectionStart || this.$refs.globalchatmessage.$el.selectionStart == '0') {
                return {
                    'start': this.$refs.globalchatmessage.$el.selectionStart,
                    'end': this.$refs.globalchatmessage.$el.selectionEnd
                };
            } else {
                return {
                    'start': 0,
                    'end': 0
                };
            }
        },
        hideMessage(postId) {
            axios.post('/chat/hide', {
                message_id: postId
            })
                .then(response => {
                })
                .catch(e => {
                    console.log(e)
                })

            let idx = this.messages.findIndex(item => item.id === postId)
            this.messages.splice(idx, 1)
        },
        showMore() {
            this.moreLoading = true
            this.page += 1

            axios.get('/chat?page=' + this.page)
                .then((response) => {
                    let tempMessages = response.data.messages.data
                    tempMessages.forEach(message => {
                        if(message.reactions != null) {
                            message.likes = message.reactions.filter(item => item.type_id === 'like')
                            message.dislikes = message.reactions.filter(item => item.type_id === 'dislike')
                        } else {
                            message.likes = []
                            message.dislikes = []
                        }
                    })

                    this.messages = [...this.messages, ...tempMessages]

                    this.moreLoading = false

                    if(response.data.messages.next_page_url == null) {
                        this.hasMore = false
                    }
                })
                .catch((e) => {console.log(e)})
        },
        handleDragIn(e) {
            this.isDraging = true
            this.counter++
            e.preventDefault()
            e.stopPropagation()
        },
        handleDragOut(e) {
            this.counter--
            if(this.counter === 0) this.isDraging = false
            e.preventDefault()
            e.stopPropagation()
        },
        handleDrag(e) {
            e.preventDefault()
            e.stopPropagation()
        },
        handleDrop(e) {
            this.isDraging = false
            e.preventDefault()
            e.stopPropagation()

            if (e.dataTransfer.files && e.dataTransfer.files.length > 0) {
                this.fileUpload(e)
                e.dataTransfer.clearData()
            }
        },
        uploadImage() {
            this.$refs.imageRef.click()
        },
        fileUpload(event) {
            let file = null

            if(event.dataTransfer) {
                file = event.dataTransfer.files[0]
            } else {
                file = event.target.files[0]
            }

            if (!this.validateFile(file)) {
                return false
            }

            this.loadedButton = false

            let formData = new FormData()

            formData.append('attach', file)
            formData.append('user_id', this.userO.id)

            axios.post('/chat/image', formData, {
                headers: {'Content-Type': 'multipart/form-data' }
            })
                .then(response => {
                    this.messages.unshift(
                        {...response.data.message, likes: [], dislikes: []}
                    )
                    this.loadedButton = true
                })
                .catch(e => {
                    console.log(e)
                    this.loadedButton = true
                })
        },
        showPreview(image) {
            this.previewImage = image
            this.preview = true
        },
        hidePreview(image) {
            this.previewImage = null
            this.preview = false
        },
        validateFile(file) {
            if (file.size > 10485760) {
                alert("Допустимо использовать изображения до 10Mb")
                return false
            }

            if (file.type !== 'image/png' &&
                file.type !== 'image/jpg' &&
                file.type !== 'image/jpeg' &&
                file.type !== 'image/webp')
            return false;

            return true
        },
        imageLoadError(image) {
            image.thumb = null
        },
        isLikedByUser(postId, userId) {
            let message = this.messages.find(item => item.id === postId)
            let reaction = message.reactions.find(item => item.user_id === userId)

            return reaction ? reaction.type_id : false
        },
        updateMessageReactions(postId, newMessageReactions) {
            let message = this.messages.find(item => item.id === postId)
            message.reactions = newMessageReactions

            if(message.reactions != null) {
                message.likes = message.reactions.filter(item => item.type_id === 'like')
                message.dislikes = message.reactions.filter(item => item.type_id === 'dislike')
            } else {
                message.likes = []
                message.dislikes = []
            }

            this.$forceUpdate()
        },
        like(postId) {
            if(this.isLikedByUser(postId, this.userO.id)) {
                this.dislike(postId)
                return false
            }

            this.$refs['post_like_' + postId][0].classList.add('like-animated')

            axios.post('/chat/react', {
                user_id: this.userO.id,
                message_id: postId,
                type_id: 'like'
            })
                .then(response => {
                    this.updateMessageReactions(postId, response.data.reactions)
                })
                .catch(e => {
                    console.log(e)
                })
        },
        dislike(postId) {
            this.$refs['post_like_' + postId][0].classList.remove('like-animated')

            axios.post('/chat/react', {
                user_id: this.userO.id,
                message_id: postId,
                type_id: 'dislike'
            })
                .then(response => {
                    this.updateMessageReactions(postId, response.data.reactions)
                })
                .catch(e => {
                    console.log(e)
                })
        },
        checkIfUserAlreadyOnline(user) {
            return this.users.findIndex(item => item.id === user.id)
        },
        addUser(user) {
            this.users.unshift(user)
        },
        removeUser(user) {
            let idx = this.users.findIndex(item => item.id === user.id)
            this.users.splice(idx, 1)
        },

        sendViaEnter: function(e) {
            this.sendChatMessage()
        },
        sendChatMessage() {
            if(this.loadedButton == false) return false;

            if(this.message != null) {
                if(this.message.trim() != '' && this.message.trim().length > 0) {

                    this.loadedButton = false
                    axios.post('/chat/send', {
                       body: this.message,
                       reply_id: this.replyId
                    }).then((response) => {
                        this.messages.unshift(
                            {...response.data.message, likes: [], dislikes: []}
                        )
                        this.message = null
                        this.$nextTick(() => {
                            this.$refs.chatfeed.scrollTop = 0
                        })
                        this.loadedButton = true
                        this.removeReply()
                    })
                    .catch(e => {
                        console.log(e)
                        this.removeReply()
                        this.loadedButton = true
                    })
                }
            }
        }
    }
}
</script>
