import { shallowMount } from '@vue/test-utils';
import ZCookies from './ZCookies.vue';

describe('ZCookies.vue', () => {
  it('renders a component', () => {
    const component = shallowMount(ZCookies);
    expect(component.get('.z-z-cookies'));
  });
});
