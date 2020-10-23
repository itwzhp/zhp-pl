import { shallowMount } from "@vue/test-utils";
import ZMenu from "./ZMenu.vue";
describe("ZMenu.vue", () => {
  it("renders a component", () => {
    const component = shallowMount(ZMenu);
    expect(component.get(".z-menu"));
  });
});
