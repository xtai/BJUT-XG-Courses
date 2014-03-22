Messenger.options = {
  extraClasses: 'messenger-fixed messenger-on-top',
  theme: 'block'
}
Messenger().post({
  type: "error",
  hideAfter: 4,
  showCloseButton: true,
  message: "用户不存在或密码错误!"
});