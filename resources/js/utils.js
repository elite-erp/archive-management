import _ from "lodash";

let trans = {
  search: "بحث ...",
  nav: {
    users: "المستخدمين",
    cpanel: "لوحة التحكم",
    documents: "المسودات",
    categories: "التصنيفات",
  },
  login: {
    title: "تسجيل دخول",
    buttons: { submit: "دخول", clear: "إلغاء" },
    user: {
      label: "إسم المستخدم",
      placeholder: "فلان...",
    },
    password: {
      label: "كلمة المرور",
      placeholder: "8 خانات",
    },
  },
};

export const t = (key) => _.get(trans, key);

export const filterLinks = (links) => links.slice(1, links.length - 1);
