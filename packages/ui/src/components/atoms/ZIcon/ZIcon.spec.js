import { shallowMount } from "@vue/test-utils";
import ZIcon from "./ZIcon.vue";
describe("ZIcon.vue", () => {
  it("renders a component", () => {
    const component = shallowMount(ZIcon);
    expect(component.contains(".z-icon")).toBe(true);
  });
});
