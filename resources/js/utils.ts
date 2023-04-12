import _ from "lodash";
import trans from "./lang";
import { router } from "@inertiajs/vue3";

export const t = (key: string) => _.get(trans, key);

export const filterLinks = (links: any[]) => links.slice(1, links.length - 1);

export function fileSelector(selector: string) {
  let element: HTMLInputElement | null = document.querySelector(selector)

  if (element != null) element.click();
}

export function changePhoto(e: any, imgSelector: string, obj: any) {
  handlePhoto(e, imgSelector, (files: any) => {
    obj.photo = files[0]
  })
}

export function handlePhoto(e: any, selector: string, callback: Function) {
  e.target.onchange = (fileChange: any) => {
    if (fileChange.target.files.length) {

      // setting up the reader
      let reader = new FileReader();
      reader.readAsDataURL(fileChange.target?.files[0]); // this is reading as data url

      reader.onload = (readerEvent) => {
        let photo: any = document.querySelector(selector);
        if (photo != null) photo.src = readerEvent.target?.result; // this is the content!
        callback(fileChange.target.files)
      };
    }
  };
}

export function uploadPhoto(e: any, imgSelector: string, url: string) {
  handlePhoto(e, imgSelector, (files: any) => {
    router.post(url, {
      photo: files[0]
    }, {
      forceFormData: true
    })
  })
}

