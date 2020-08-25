import { shallowMount } from '@vue/test-utils';
import ZBanner from './ZBanner.vue';

describe('ZBanner.vue', () => {
  it('renders a component', () => {
    const component = shallowMount(ZBanner);
    expect(component.contains('.z-banner')).toBe(true);
  });
});
