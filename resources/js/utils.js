import _ from "lodash";

let trans = {
  nav: {
    users: "المستخدمين",
    cpanel: "لوحة التحكم",
    documents: "المسودات",
    categories: "التصنيفات",
  },
};

export const t = (key) => _.get(trans, key);
