import { shallowMount } from "@vue/test-utils";
import ZFacebook from "./ZFacebook.vue";
describe("ZFacebook.vue", () => {
  it("renders a component", () => {
    const component = shallowMount(ZFacebook);
    expect(component.get(".z-facebook"));
  });
});
