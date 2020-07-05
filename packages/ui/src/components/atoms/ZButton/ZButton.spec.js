import { shallowMount } from "@vue/test-utils";
import ZButton from "./ZButton.vue";
describe("ZButton.vue", () => {
  it("renders a component", () => {
    const component = shallowMount(ZButton);
    expect(component.contains(".z-button")).toBe(true);
  });
});
