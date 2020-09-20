import { shallowMount } from "@vue/test-utils";
import ZUser from "./ZUser.vue";
describe("ZUser.vue", () => {
  it("renders a component", () => {
    const component = shallowMount(ZUser);
    expect(component.get(".z-user"));
  });
});
